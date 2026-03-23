<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->where('role', '!=', 'admin')
            ->withCount('referrals')
            ->select('users.*');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('account_id', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('risk') && $request->risk === 'shared_ip') {
            $query->where(function ($query) {
                $query->whereNotNull('last_login_ip')
                    ->whereExists(function ($subQuery) {
                        $subQuery->selectRaw('1')
                            ->from('users as other_users')
                            ->whereColumn('other_users.id', '!=', 'users.id')
                            ->where('other_users.role', '!=', 'admin')
                            ->where(function ($ipMatch) {
                                $ipMatch->whereColumn('other_users.last_login_ip', 'users.last_login_ip')
                                    ->orWhereColumn('other_users.registration_ip', 'users.last_login_ip');
                            });
                    });
            })->orWhere(function ($query) {
                $query->whereNotNull('registration_ip')
                    ->whereExists(function ($subQuery) {
                        $subQuery->selectRaw('1')
                            ->from('users as other_users')
                            ->whereColumn('other_users.id', '!=', 'users.id')
                            ->where('other_users.role', '!=', 'admin')
                            ->where(function ($ipMatch) {
                                $ipMatch->whereColumn('other_users.last_login_ip', 'users.registration_ip')
                                    ->orWhereColumn('other_users.registration_ip', 'users.registration_ip');
                            });
                    });
            });
        }
        
        $users = $query->latest('users.created_at')
            ->paginate(10)
            ->appends($request->all())
            ->through(function ($user) {
                $user->tracked_ip_address = $user->last_login_ip ?: $user->registration_ip;
                $user->tracked_user_agent = $user->last_login_user_agent ?: $user->registration_user_agent;
                $user->device_label = $this->extractDeviceLabel($user->tracked_user_agent);
                $user->shared_ip_users = $this->getSharedIpUsers($user);
                $user->same_ip_users_count = $user->shared_ip_users->count();
                $user->shared_ip_usernames = $user->shared_ip_users
                    ->pluck('username')
                    ->filter()
                    ->take(3)
                    ->implode(', ');

                return $user;
            });

        return view('admin.users.index', compact('users'));
    }

    private function extractDeviceLabel(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'Unknown';
        }

        $platform = match (true) {
            Str::contains($userAgent, 'Windows') => 'Windows',
            Str::contains($userAgent, ['iPhone', 'iPad']) => 'iOS',
            Str::contains($userAgent, 'Android') => 'Android',
            Str::contains($userAgent, 'Mac OS X') => 'macOS',
            Str::contains($userAgent, 'Linux') => 'Linux',
            default => 'Unknown OS',
        };

        $browser = match (true) {
            Str::contains($userAgent, 'Edg/') => 'Edge',
            Str::contains($userAgent, 'OPR/') => 'Opera',
            Str::contains($userAgent, 'Firefox/') => 'Firefox',
            Str::contains($userAgent, 'Chrome/') && !Str::contains($userAgent, 'Edg/') => 'Chrome',
            Str::contains($userAgent, 'Safari/') && !Str::contains($userAgent, 'Chrome/') => 'Safari',
            default => 'Browser',
        };

        return $platform . ' / ' . $browser;
    }
    
    public function create()
    {
        return view('admin.users.create');
    }

    public function duplicateIps(Request $request)
    {
        $ipSources = User::query()
            ->where('role', '!=', 'admin')
            ->selectRaw('id, username, email, account_id, balance, created_at, COALESCE(last_login_ip, registration_ip) as tracked_ip')
            ->selectRaw('COALESCE(last_login_user_agent, registration_user_agent) as tracked_user_agent');

        $duplicateIpGroups = DB::query()
            ->fromSub($ipSources, 'user_ips')
            ->selectRaw('tracked_ip, COUNT(*) as account_count')
            ->whereNotNull('tracked_ip')
            ->groupBy('tracked_ip')
            ->havingRaw('COUNT(*) > 1')
            ->orderByDesc('account_count')
            ->orderBy('tracked_ip');

        if ($request->filled('search')) {
            $duplicateIpGroups->where('tracked_ip', 'like', '%' . $request->search . '%');
        }

        $clusters = $duplicateIpGroups
            ->paginate(15)
            ->appends($request->all())
            ->through(function ($cluster) use ($ipSources) {
                $users = DB::query()
                    ->fromSub($ipSources, 'user_ips')
                    ->where('tracked_ip', $cluster->tracked_ip)
                    ->orderBy('created_at')
                    ->get()
                    ->map(function ($user) {
                        $user->device_label = $this->extractDeviceLabel($user->tracked_user_agent);
                        return $user;
                    });

                $cluster->users = $users;
                return $cluster;
            });

        return view('admin.users.duplicate-ips', compact('clusters'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'account_id' => 'USR' . strtoupper(substr(md5(uniqid()), 0, 8)),
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }
    
    public function show(User $user)
    {
        $user->tracked_ip_address = $user->last_login_ip ?: $user->registration_ip;
        $user->tracked_user_agent = $user->last_login_user_agent ?: $user->registration_user_agent;
        $user->device_label = $this->extractDeviceLabel($user->tracked_user_agent);
        $sharedIpUsers = $this->getSharedIpUsers($user);

        return view('admin.users.show', compact('user', 'sharedIpUsers'));
    }

    private function getSharedIpUsers(User $user): Collection
    {
        $trackedIpAddress = $user->last_login_ip ?: $user->registration_ip;

        if (!$trackedIpAddress) {
            return collect();
        }

        return User::query()
            ->where('id', '!=', $user->id)
            ->where('role', '!=', 'admin')
            ->where(function ($query) use ($trackedIpAddress) {
                $query->where('last_login_ip', $trackedIpAddress)
                    ->orWhere('registration_ip', $trackedIpAddress);
            })
            ->orderBy('username')
            ->get(['id', 'username', 'email', 'account_id', 'created_at']);
    }
    
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
            'role' => 'sometimes|required|in:user,admin',
            'balance' => 'nullable|numeric|min:0',
        ]);
        
        if ($request->has('username')) {
            $user->username = $request->username;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('role')) {
            $user->role = $request->role;
        }
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        
        if ($request->has('balance')) {
            $user->balance = $request->balance;
        }
        
        $user->save();
        
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
