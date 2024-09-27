<?php

namespace App\Http\Controllers;

use App\Mail\ApproveMail;
use App\Models\PermintaanPembelian;
use Dompdf\Dompdf;
use App\Models\PtTujuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

            $to="itsupport@imligroup.com";
            $msg=$pp;
            $subject = "Pengajuan Permintaan Pembelian Internal - IT";

            Mail::to($to)->send(new ApproveMail($msg,$subject));
    
            return redirect()->route('permintaan')->with('success', 'Permintaan pembelian created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => 'Validation error: ' . $e->getMessage()]);
        }
    }    

    public function printpp($id){
        $pp = PermintaanPembelian::with(['user','pt_tujuan'])->find($id);
        $html = view('printpp',compact('pp'))->render();

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
