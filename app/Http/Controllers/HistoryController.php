<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $data = PermintaanPembelian::with('pt_tujuan')->where('status', 'acc2')->latest()->paginate(20);
        return view('history', ['title' => 'History', 'datas' => $data]);
    }
}
