<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $employeesCount = User::where('role', 'employee')->count();
        $approvedLeavesCount = Leave::where('status', 'approved')->count();
        $rejectedLeavesCount = Leave::where('status', 'rejected')->count();
        $pendingLeavesCount = Leave::where('status', 'pending')->count();
        return inertia('Admin/Dashboard', compact('employeesCount', 'approvedLeavesCount', 'rejectedLeavesCount', 'pendingLeavesCount'));
    }
}
