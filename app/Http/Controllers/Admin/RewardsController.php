<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralEarning;
use App\Models\CheckIn;
use App\Models\LuckyBox;
use App\Models\User;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'commissions');
        $perPage = 10;
        
        // Resolve page numbers from request
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($request) {
            return $request->get('commissions_page', 1);
        });
        $commissions = ReferralEarning::with(['user', 'fromUser'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'commissions_page')
            ->setPath(route('admin.rewards.index'));
        
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($request) {
            return $request->get('checkins_page', 1);
        });
        $checkins = CheckIn::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'checkins_page')
            ->setPath(route('admin.rewards.index'));
        
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($request) {
            return $request->get('luckyboxes_page', 1);
        });
        $luckyBoxes = LuckyBox::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'luckyboxes_page')
            ->setPath(route('admin.rewards.index'));
        
        // Return JSON for AJAX requests
        if ($request->ajax()) {
            $type = $request->get('type');
            if ($type === 'checkins') {
                return response()->json([
                    'html' => view('admin.rewards.partials.checkins-table', compact('checkins'))->render(),
                    'pagination' => view('admin.rewards.partials.checkins-pagination', compact('checkins'))->render()
                ]);
            } elseif ($type === 'luckyboxes') {
                return response()->json([
                    'html' => view('admin.rewards.partials.luckyboxes-table', compact('luckyBoxes'))->render(),
                    'pagination' => view('admin.rewards.partials.luckyboxes-pagination', compact('luckyBoxes'))->render()
                ]);
            } elseif ($type === 'commissions') {
                return response()->json([
                    'html' => view('admin.rewards.partials.commissions-table', compact('commissions'))->render(),
                    'pagination' => view('admin.rewards.partials.commissions-pagination', compact('commissions'))->render()
                ]);
            }
        }
        
        return view('admin.rewards.index', compact('commissions', 'checkins', 'luckyBoxes', 'tab'));
    }

    // Commission CRUD
    public function createCommission()
    {
        $users = User::all();
        return view('admin.rewards.commission-create', compact('users'));
    }

    public function storeCommission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'from_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'level' => 'required|integer|min:1|max:3',
        ]);

        ReferralEarning::create($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Commission created successfully');
    }

    public function editCommission($id)
    {
        $commission = ReferralEarning::findOrFail($id);
        $users = User::all();
        return view('admin.rewards.commission-edit', compact('commission', 'users'));
    }

    public function updateCommission(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'from_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'level' => 'required|integer|min:1|max:3',
        ]);

        ReferralEarning::findOrFail($id)->update($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Commission updated successfully');
    }

    public function destroyCommission($id)
    {
        ReferralEarning::findOrFail($id)->delete();
        return back()->with('success', 'Commission deleted successfully');
    }

    // Check-in CRUD
    public function createCheckin()
    {
        $users = User::all();
        return view('admin.rewards.checkin-create', compact('users'));
    }

    public function storeCheckin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'day' => 'required|integer|min:1|max:7',
            'reward' => 'required|numeric|min:0',
        ]);

        CheckIn::create($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Check-in created successfully');
    }

    public function editCheckin($id)
    {
        $checkin = CheckIn::findOrFail($id);
        $users = User::all();
        return view('admin.rewards.checkin-edit', compact('checkin', 'users'));
    }

    public function updateCheckin(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'day' => 'required|integer|min:1|max:7',
            'reward' => 'required|numeric|min:0',
        ]);

        CheckIn::findOrFail($id)->update($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Check-in updated successfully');
    }

    public function destroyCheckin($id)
    {
        CheckIn::findOrFail($id)->delete();
        return back()->with('success', 'Check-in deleted successfully');
    }

    // Lucky Box CRUD
    public function createLuckyBox()
    {
        $users = User::all();
        return view('admin.rewards.luckybox-create', compact('users'));
    }

    public function storeLuckyBox(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reward' => 'required|numeric|min:0',
        ]);

        LuckyBox::create($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Lucky box created successfully');
    }

    public function editLuckyBox($id)
    {
        $luckyBox = LuckyBox::findOrFail($id);
        $users = User::all();
        return view('admin.rewards.luckybox-edit', compact('luckyBox', 'users'));
    }

    public function updateLuckyBox(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reward' => 'required|numeric|min:0',
        ]);

        LuckyBox::findOrFail($id)->update($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Lucky box updated successfully');
    }

    public function destroyLuckyBox($id)
    {
        LuckyBox::findOrFail($id)->delete();
        return back()->with('success', 'Lucky box deleted successfully');
    }
}
