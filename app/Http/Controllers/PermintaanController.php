<?php

namespace App\Http\Controllers;

use App\Mail\ApproveMail;
use App\Models\Barang;
use App\Models\PermintaanPembelian;
use Dompdf\Dompdf;
use App\Models\PtTujuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PermintaanController extends Controller
{
    public function index()
    {
        $pt_tujuan = PtTujuan::all();
        return view('permintaan', ['title' => 'Permintaan Pembeliaan', 'pts' => $pt_tujuan]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        try {
            $validate = $request->validate([
                'pt_tujuan_id' => 'required|exists:pt_tujuans,id',
                'alasan' => 'required|string'
            ]);

            // Get the current year and month in "MMYY" format
            $currentYearMonth = now()->format('my'); // "MMYY" format

            // Find the last 'nomor' for the current year (IT004-YYYYMM-XXXX)
            $lastPermintaan = PermintaanPembelian::where('nomor', 'LIKE', 'IT004-' . $currentYearMonth . '-%')
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

            $pp = new PermintaanPembelian();
            $pp->user_id = $user_id;
            $pp->pt_tujuan_id = $validate['pt_tujuan_id'];
            $pp->alasan = $validate['alasan'];
            $pp->nomor = $nomor;
            $pp->save();

            $to = "itsupport@imligroup.com";
            $msg = $pp;
            $subject = "Pengajuan Permintaan Pembelian Internal - IT";

            Mail::to($to)->send(new ApproveMail($msg, $subject));


            return redirect()->route('permintaan')->with('success', 'Permintaan pembelian created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => 'Validation error: ' . $e->getMessage()]);
        }
    }

    public function approvalIndex($id)
    {
        $pt_tujuan = PtTujuan::all();
        $dataPP = PermintaanPembelian::with(['user', 'barang', 'pt_tujuan'])->findOrFail($id);
        $barangData = Barang::where('pp_id', $id)->get();
        return view('edit', ['data' => $dataPP, 'title' => 'Approval permintaan', 'pts' => $pt_tujuan, 'barangData' => $barangData]);
    }

    public function editIndex($id)
    {
        $pt_tujuan = PtTujuan::all();
        $dataPP = PermintaanPembelian::with(['user', 'barang', 'pt_tujuan'])->findOrFail($id);
        return view('edit', ['data' => $dataPP, 'title' => 'Edit permintaan', 'pts' => $pt_tujuan]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 'user' && Auth::user()->name != Auth::user()->department->leader->name) {
            try {
                $validated = $request->validate([
                    'pt_tujuan_id' => 'required|exists:pt_tujuans,id',
                    'alasan' => 'required|string'
                ]);

                $pp = PermintaanPembelian::findOrFail($id);
                $pp->pt_tujuan_id = $validated['pt_tujuan_id'];
                $pp->alasan = $validated['alasan'];
                $pp->status = 'acc0';
                $pp->save();
                return redirect()->route('permintaan.edit', $id)->with('success', 'Permintaan pembelian berhasil di edit!');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->withErrors(['error' => 'Validation error: ' . $e->getMessage()]);
            }
        } elseif (Auth::user()->role == 'admin') {
            try {
                $validated = $request->validate([
                    'dataArray' => 'required|json',
                    'status' => 'required|string',
                ]);

                $dataArray = json_decode($validated['dataArray'], true);

                // Retrieve existing barang records related to the given pp_id
                $existingBarangs = Barang::with('permintaan_pembelian')->where('pp_id', $id)->get();

                // Create an array of existing barang IDs for comparison
                $existingBarangIds = $existingBarangs->pluck('id')->toArray();
                $idsToDelete = $existingBarangIds;
                $updatedIds = [];

                // Iterate over the provided data array to update or create records
                foreach ($dataArray as $data) {
                    $barangId = $data['id'] ?? '';
                    $tanggalDiperlukan = \DateTime::createFromFormat('d-m-Y', $data['tanggal_diperlukan'])->format('Y-m-d');

                    if ($barangId) {
                        // Update the existing barang if the ID exists
                        $barang = Barang::find($barangId);
                        if ($barang) {
                            $barang->update([
                                'nama' => $data['nama'],
                                'jumlah' => $data['jumlah'],
                                'satuan' => $data['satuan'],
                                'tanggal_diperlukan' => $tanggalDiperlukan,
                                'keterangan_it' => $data['keterangan_it']
                            ]);
                            // Mark this ID as updated
                            $updatedIds[] = $barangId;
                            // Remove this ID from the delete list
                            $idsToDelete = array_diff($idsToDelete, [$barangId]);
                        }
                    } else {
                        // Create a new barang if the ID is empty
                        $newBarang = Barang::create([
                            'pp_id' => $id,
                            'nama' => $data['nama'],
                            'jumlah' => $data['jumlah'],
                            'satuan' => $data['satuan'],
                            'tanggal_diperlukan' => $tanggalDiperlukan,
                            'keterangan_it' => $data['keterangan_it']
                        ]);
                        // Mark the new ID as updated
                        $updatedIds[] = $newBarang->id;
                    }
                }

                // Delete any IDs that are not in the updated list
                foreach ($idsToDelete as $idToDelete) {
                    if (!in_array($idToDelete, $updatedIds)) {
                        Barang::destroy($idToDelete);
                    }
                }

                if ($validated['status'] == 'approve') {
                    $dataPP = PermintaanPembelian::with(['user', 'barang'])->findOrFail($id);
                    $dataPP->status = 'acc1';
                    $dataPP->it_confirm_date = Carbon::now();
                    $dataPP->revision_user = null;
                    $dataPP->save();

                    return redirect()->route('permintaan.approval', $id)->with('success', 'Permintaan pembelian diapprove!');
                } elseif ($validated['status'] == 'disapprove') {
                    $dataPP = PermintaanPembelian::with(['user', 'barang'])->findOrFail($id);
                    $dataPP->status = 'acc-1';
                    $dataPP->it_confirm_date = Carbon::now();
                    $revisi = $request->validate([
                        'revisi' => 'nullable|string'
                    ]);
                    $dataPP->revision_user = $revisi['revisi'];
                    $dataPP->save();
                    return redirect()->route('permintaan.approval', $id)->with('success', 'Permintaan pembelian disapprove!');
                }

                return redirect()->route('permintaan.approval', $id)->with('success', 'Permintaan pembelian berhasil tersimpan.');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->withErrors(['error' => 'Validation error: ' . $e->getMessage()]);
            }
        } elseif (Auth::user()->name == Auth::user()->department->leader->name) {
            $validated = $request->validate([
                'status' => 'required|string',
            ]);

            if ($validated['status'] == 'approve') {
                $dataPP = PermintaanPembelian::with(['user', 'barang'])->findOrFail($id);
                $dataPP->status = 'acc2';
                $dataPP->manager_confirm_date = Carbon::now();
                $dataPP->revision_it = null;
                $dataPP->save();
                return redirect()->route('history', $id)->with('success', 'Permintaan pembelian diapprove!');
            } elseif ($validated['status'] == 'disapprove') {
                $dataPP = PermintaanPembelian::with(['user', 'barang'])->findOrFail($id);
                $dataPP->status = 'acc-2';
                $dataPP->manager_confirm_date = Carbon::now();
                $revisi = $request->validate([
                    'revisi' => 'nullable|string'
                ]);
                $dataPP->revision_it = $revisi['revisi'];
                $dataPP->save();
                return redirect()->route('permintaan.approval', $id)->with('success', 'Permintaan pembelian disapprove!');
            }
        }
    }


    public function printpp($id)
    {
        $pp = PermintaanPembelian::with(['user', 'pt_tujuan', 'barang'])->find($id);
        $html = view('printpp', compact('pp', ))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $filePath = storage_path('app/public/pp.pdf');
        file_put_contents($filePath, $output);

        return $dompdf->stream($filePath, ['Attachment' => 0]);
    }
}
