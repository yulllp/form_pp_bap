<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user is authenticated and if the profile is incomplete
        if ($user && (empty($user->email) || empty($user->tahun_masuk) || empty($user->department_id) || empty($user->ttd))) {
            // Allow access only to dashboard and profile routes
            if (!$request->is('dashboard') && !$request->is('profile')) {
                return redirect('/dashboard')->with('message', 'Please complete your profile before accessing other pages.');
            }
        }

        return $next($request);
    }
}
