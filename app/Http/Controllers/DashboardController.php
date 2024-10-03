<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Brand;
use App\Models\Office;
use App\Models\OS;
use App\Models\PtTujuan;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isProfileIncomplete = empty($user->email) || empty($user->tahun_masuk) || empty($user->department_id) || empty($user->ttd);
        return view('dashboard', ['title' => "Dashboard", 'isProfileIncomplete' => $isProfileIncomplete]);
    }

    public function showForm(){
        $users = User::with('department')->orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $oss = OS::orderBy('name')->get();
        $offices = Office::orderBy('name')->get();
        $companies = PtTujuan::orderBy('name')->get();
        $title = 'Berita Acara Pengakuan';
        return view('bap', ['title' => $title, 'users' => $users, 'brands'=>$brands,'types'=>$types,'oss'=>$oss,'offices'=>$offices,'companies'=>$companies]);
    }

    public function editIndex(Request $request){
        
    }

    // public function onGoingBAP(){
    //     $title = "On Going - BAP";
    //     $beritas = BeritaAcara::with('users')
    // }
}
