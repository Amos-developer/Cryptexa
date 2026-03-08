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
        
        $commissions = ReferralEarning::with(['user', 'fromUser'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'commissions_page');
            
        $checkins = CheckIn::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'checkins_page');
            
        $luckyBoxes = LuckyBox::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'luckyboxes_page');
        
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
