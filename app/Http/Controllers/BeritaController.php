<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\DetailBarang;
use App\Models\Pembelian;
use App\Models\Pengecekan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function store(Request $request)
    {
        // dd('test');
        try {
            $validated = $request->validate([
                'name' => 'nullable|string',
                'department' => 'nullable|string',
                'tanggal' => 'nullable|date',
                'brand' => 'nullable|string',
                'type' => 'nullable|string',
                'spek' => 'nullable|string',
                'serial' => 'nullable|string',
                'pc_name' => 'nullable|string',
                'password' => 'nullable|string',
                'os' => 'nullable|string',
                'os_pk' => 'nullable|string',
                'office' => 'nullable|string',
                'office_pk' => 'nullable|string',
                'other' => 'nullable|string',
                'company' => 'nullable|string',
                'pp' => 'nullable|string',
                'tanggal_pp' => 'nullable|date',
                'po' => 'nullable|string',
                'tanggal_po' => 'nullable|date',
                'sj' => 'nullable|string',
                'tanggal_sj' => 'nullable|date',
                'tanggal_rd' => 'nullable|date',
                'checker' => 'nullable|string',
                'tanggal_check' => 'nullable|date',
                'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // dd($validated);

            $gambar1Path = null;
            $gambar2Path = null;

            if ($request->hasFile('gambar1')) {
                $gambar1 = $request->file('gambar1');
                $gambar1Name = time() . '.' . $gambar1->getClientOriginalExtension();
                $gambar1Path = $request->file('gambar1')->storeAs('foto-bap', $gambar1Name, 'public');
            }

            if ($request->hasFile('gambar2')) {
                $gambar2 = $request->file('gambar2');
                $gambar2Name = time() . '.' . $gambar2->getClientOriginalExtension();
                $gambar2Path = $request->file('gambar2')->storeAs('foto-bap', $gambar2Name, 'public');
            }

            // Get the current year and month in "MMYY" format
            $currentYearMonth = now()->format('my'); // "MMYY" format

            // Find the last 'nomor' for the current year (IT004-YYYYMM-XXXX)
            $lastPermintaan = BeritaAcara::where('nomor', 'LIKE', 'IT001-' . $currentYearMonth . '-%')
                ->orderBy('nomor', 'desc')
                ->first();

            // Generate the increment number, starting from 1 each year
            if ($lastPermintaan) {
                $lastIncrement = (int) substr($lastPermintaan->nomor, -4); // Get the last 4 digits
                $nextIncrement = $lastIncrement + 1;
            } else {
                $nextIncrement = 1;
            }

            // Format the increment with leading zeros (e.g., 0001, 0002)
            $formattedIncrement = str_pad($nextIncrement, 4, '0', STR_PAD_LEFT);

            // Create the new 'nomor' in the format 'IT004-MMYY-XXXX'
            $nomor = 'IT004-' . $currentYearMonth . '-' . $formattedIncrement;

            $beritaacara = new BeritaAcara();
            $beritaacara->pembuat_id = Auth::id();
            $beritaacara->nomor = $nomor;
            $beritaacara->penerima_id = $validated['name'];
            $beritaacara->tanggal_dibuat = $validated['tanggal'];

            $detail_barang = new DetailBarang();
            $detail_barang->brand_id = $validated['brand'];
            $detail_barang->type_id = $validated['type'];
            $detail_barang->serial_number = $validated['serial'];
            $detail_barang->pc_name = $validated['pc_name'];
            $detail_barang->password = $validated['password'];
            $detail_barang->os_id = $validated['os'];
            $detail_barang->os_product_key = $validated['os_pk'];
            $detail_barang->office_id = $validated['office'];
            $detail_barang->office_product_key = $validated['office_pk'];
            $detail_barang->other = $validated['other'];
            $detail_barang->save();
            $beritaacara->detail_barang_id = $detail_barang->id;

            $pembelian = new Pembelian();
            $pembelian->company_id = $validated['company'];
            $pembelian->pp = $validated['pp'];
            $pembelian->pp_date = $validated['tanggal_pp'];
            $pembelian->po = $validated['po'];
            $pembelian->po_date = $validated['tanggal_po'];
            $pembelian->sj = $validated['sj'];
            $pembelian->sj_date = $validated['tanggal_sj'];
            $pembelian->receipt_date = $validated['tanggal_rd'];
            $pembelian->save();
            $beritaacara->pembelian_id = $pembelian->id;

            $pengecekan = new Pengecekan();
            $pengecekan->checker = $validated['checker'];
            $pengecekan->checking_date = $validated['tanggal_check'];
            $pengecekan->foto1 = $gambar1Path;
            $pengecekan->foto2 = $gambar2Path;
            $pengecekan->save();
            $beritaacara->pengecekan_id = $pengecekan->id;

            $beritaacara->ttd_pengecekan_id = Auth::id();
            $beritaacara->pengecekan_date = now();
            $beritaacara->save();

            return back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }



    public function print(){

    }
}
