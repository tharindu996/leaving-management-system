<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveStoreRequest;
use App\Http\Requests\LeaveUpdateRequest;
use App\Models\Leave;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = auth()->user()->leaves;
        return inertia('Employee/Leaves/Index', compact('leaves'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        return inertia('Employee/Leaves/Show', compact('leave'));
    }

    /**
     * Store the specified resource in storage.
     */
    public function store(LeaveStoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = auth()->user()->id;
        $leave = Leave::create($inputs);
        return redirect()->route('employee.leaves.index')->with('success', 'Leave request is submitted successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveUpdateRequest $request, Leave $leave)
    {
        $inputs = $request->validated();

        $leave->update([
            'leave_date' => $inputs['leave_date'],
            'description' => $inputs['description'],
        ]);

        return redirect()->route('employee.leaves.index')->with('success', 'Leave request is updated successfully.');
    }

    /**
     * Destroy the specified resource in storage.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('employee.leaves.index')->with('success', 'Leave request is deleted successfully.');
    }
}
