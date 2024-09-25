<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function index() {
        return view('permintaan', ['title' => 'Permintaan Pembeliaan']);
    }

    public function store(Request $request) {
        $user_id = Auth::id();

        try {
            $validate = $request->validate([
                'pt_tujuan_id' => 'required|exists: pt_tujuans,id',
                'alasan' => 'required|string'
            ]);
            $pp = new PermintaanPembelian();
            $pp->user_id = $user_id;
            $pp->pt_tujuan = $validate['pt_tujuan_id'];
            $pp->alasan = $validate['alasan'];
            $pp->save();
        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => 'Validation error: ' . $e->getMessage()]);
        }


    }
}
