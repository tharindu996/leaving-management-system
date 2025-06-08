<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();

        return inertia('Admin/Leaves/Index', compact('leaves'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        return inertia('Admin/Leaves/Show', compact('leave'));
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {      
        $leave->update([
            'is_approved' => !$leave->is_approved,
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave status updated successfully.');
    }   
}
