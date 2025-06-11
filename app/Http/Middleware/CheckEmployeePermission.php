<?php

namespace App\Http\Middleware;

use App\Models\Leave;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $leave = $request->route('leave');

        // Ensure the leave request exists and the authenticated user owns it.       
        if ($leave && $leave->user->id !== auth()->id()) {
            return redirect()->back()->withErrors([
                'error' => 'Access denied.',
            ]);
        }

        return $next($request);
    }
}
