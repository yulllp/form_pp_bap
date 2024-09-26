<?php

namespace App\Http\Controllers;

use App\Models\PermintaanPembelian;
use App\Models\PtTujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function index() {
        $pt_tujuan = PtTujuan::all();
        return view('permintaan', ['title' => 'Permintaan Pembeliaan', 'pts' => $pt_tujuan]);
    }

    public function store(Request $request) {
        $user_id = Auth::id();

        try {
            $validate = $request->validate([
                'pt_tujuan_id' => 'required|exists:pt_tujuans,id',
                'alasan' => 'required|string'
            ]);
            $pp = new PermintaanPembelian();
            $pp->user_id = $user_id;
            $pp->pt_tujuan_id = $validate['pt_tujuan_id'];
            $pp->alasan = $validate['alasan'];
            $pp->save();

            return redirect()->route('permintaan')->with('success', 'Permintaan pembelian created successfully.');
        }
        catch (\Exception $e) {
            dd($e->getMessage());   
            return back()->withErrors(['error' => 'Validation error: ' . $e->getMessage()]);
        }
    }
}
