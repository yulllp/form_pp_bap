<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isProfileIncomplete = empty($user->email) || empty($user->tahun_masuk) || empty($user->department_id);
        return view('dashboard', ['title' => "Dashboard", 'isProfileIncomplete' => $isProfileIncomplete]);
    }
}
