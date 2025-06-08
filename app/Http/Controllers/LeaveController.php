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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
    }   

    /**
     * Update the specified resource in storage.
     */
    public function approveLeave(Request $request, Leave $leave)
    {      
       
    }   
}
