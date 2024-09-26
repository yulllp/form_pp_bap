<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use Illuminate\Http\Request;

class OngoingController extends Controller
{
    public function index() {
        $data = PermintaanPembelian::with('pt_tujuan')->whereNot('status', 'acc2')->get();
        return view('ongoing', ['title' => 'On Going', 'datas' => $data]);
    }
}
