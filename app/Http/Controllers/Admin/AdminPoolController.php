<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComputePlan;
use Illuminate\Http\Request;

class AdminPoolController extends Controller
{
    public function index()
    {
        $pools = ComputePlan::latest()->paginate(10);
        return view('admin.pools.index', compact('pools'));
    }
    
    public function create()
    {
        return view('admin.pools.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'max_investment' => 'nullable|numeric|gte:price',
            'daily_profit' => 'required|numeric|min:0|max:100',
            'duration_minutes' => 'required|integer|min:1440|multiple_of:1440',
            'compound_interest' => 'nullable|boolean',
        ]);
        
        $validated['compound_interest'] = $validated['compound_interest'] ?? true;
        
        ComputePlan::create($validated);
        
        return redirect()->route('admin.pools.index')->with('success', 'Pool created successfully');
    }
    
    public function show(ComputePlan $pool)
    {
        return view('admin.pools.show', compact('pool'));
    }
    
    public function edit(ComputePlan $pool)
    {
        return view('admin.pools.edit', compact('pool'));
    }
    
    public function update(Request $request, ComputePlan $pool)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'max_investment' => 'nullable|numeric|gte:price',
            'daily_profit' => 'required|numeric|min:0|max:100',
            'duration_minutes' => 'required|integer|min:1440|multiple_of:1440',
            'compound_interest' => 'nullable|boolean',
        ]);
        
        $validated['compound_interest'] = $validated['compound_interest'] ?? true;
        
        $pool->update($validated);
        
        return redirect()->route('admin.pools.index')->with('success', 'Pool updated successfully');
    }
    
    public function destroy(ComputePlan $pool)
    {
        $pool->delete();
        return redirect()->route('admin.pools.index')->with('success', 'Pool deleted successfully');
    }
}
