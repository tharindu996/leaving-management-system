<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $totalLeaves = auth()->user()->leaves->count();
        $approvedLeaves = auth()->user()->leaves->where('status', 'approved')->count();
        $pendingLeaves = auth()->user()->leaves->where('status', 'pending')->count();
        $rejectedLeaves = auth()->user()->leaves->where('status', 'rejected')->count();
        return inertia('Dashboard', compact(
            'totalLeaves',
            'approvedLeaves',
            'pendingLeaves',
            'rejectedLeaves'
        ));
    }
}
