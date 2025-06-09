<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::with('user')->get();
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
    public function approveLeave(Request $request, Leave $leave)
    {
       
        if ($leave->leave_date < now()) {
            return redirect()->route('admin.leaves.index')->with('error', 'Cannot approve leave for past dates.');
        }

        $leave->update([
            'status' => 'approved',
        ]);


        return redirect()->route('admin.leaves.index')->with('success', 'Leave status updated successfully.');
    }

    public function rejectLeave(Request $request, Leave $leave)
    {
        $leave->update([
            'status' => 'rejected',
        ]);
        return redirect()->route('admin.leaves.index')->with('success', 'Leave status updated successfully.');
    }
}
