<?php

namespace App\Http\Controllers;

use App\Mail\AccBAPITkePurchasing;
use App\Mail\AccBAPPurchasingkeUser;
use App\Mail\NotifBAPIT;
use App\Models\BeritaAcara;
use App\Models\Brand;
use App\Models\Department;
use App\Models\DetailBarang;
use App\Models\Office;
use App\Models\OS;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengecekan;
use App\Models\PtTujuan;
use App\Models\Type;
use App\Models\User;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;

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
            $nomor = 'IT001-' . $currentYearMonth . '-' . $formattedIncrement;

            $beritaacara = new BeritaAcara();
            $beritaacara->pembuat_id = Auth::id();
            $beritaacara->nomor = $nomor;
            $beritaacara->penerima_id = $validated['name'];
            $beritaacara->tanggal_dibuat = $validated['tanggal'];

            $detail_barang = new DetailBarang();
            $detail_barang->brand_id = $validated['brand'];
            $detail_barang->type_id = $validated['type'];
            $detail_barang->spesifikasi = $validated['spek'];
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

            $purchasing = User::whereHas('department', function ($query) {
                $query->where('nama', 'purchasing');
            })->get();

            // dd($purchasing);

            $msg = $beritaacara;
            $subject = "Pengajuan Berita Acara Pengakuan dan Penerimaan Aset";

            if ($purchasing->isNotEmpty()) {
                foreach ($purchasing as $to) {
                    $email = $to->email;

                    if ($email) {
                        // Send email
                        Mail::to($email)->send(new AccBAPITkePurchasing($msg, $subject));
                    }
                }
            }

            return back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function editIndex($id)
    {
        $berita = BeritaAcara::with('penerima', 'pembuat', 'detail_barang', 'pembelian', 'pengecekan')->findOrFail($id);
        $title = 'Edit - Berita Acara Pengakuan';
        $users = User::with('department')->orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $oss = OS::orderBy('name')->get();
        $offices = Office::orderBy('name')->get();
        $companies = PtTujuan::orderBy('name')->get();
        return view('bap-edit', ['berita' => $berita, 'title' => $title, 'users' => $users, 'brands' => $brands, 'types' => $types, 'oss' => $oss, 'offices' => $offices, 'companies' => $companies]);
    }

    public function onGoingIndex()
    {
        $title = "On Going - BAP";
        if (in_array(Auth::user()->department->nama, ['IT', 'purchasing'])) {
            // Show all except status 'acc3' for IT or purchasing departments
            $beritas = BeritaAcara::with('penerima', 'pembuat')
                ->whereNot('status', 'acc3')
                ->paginate(20);
        } elseif (BeritaAcara::where('penerima_id', Auth::id())->exists()) {
            // If the user is the penerima, show their BeritaAcara along with department-related ones
            $beritas = BeritaAcara::with('penerima', 'pembuat')
                ->where(function ($query) {
                    $query->where('penerima_id', Auth::id())
                        ->orWhereHas('penerima.department', function ($q) {
                            $q->where('pemimpin_id', Auth::id());
                        });
                })
                ->whereNot('status', 'acc3')
                ->paginate(20);
        } elseif (
            BeritaAcara::whereHas('penerima.department', function ($query) {
                // If the user is a leader, show all BeritaAcara related to their department
                $query->where('pemimpin_id', Auth::id());
            })->exists()
        ) {
            $beritas = BeritaAcara::with('penerima', 'pembuat')
                ->whereHas('penerima.department', function ($query) {
                    $query->where('pemimpin_id', Auth::id());
                })
                ->whereNot('status', 'acc3')
                ->paginate(20);
        } else {
            // If no matching BeritaAcara, return empty paginator
            $beritas = new LengthAwarePaginator([], 0, 20);
        }

        return view('bap-ongoing', ['title' => $title, 'beritas' => $beritas]);
    }

    public function historyIndex()
    {
        $title = "History - BAP";
        if (in_array(Auth::user()->department->nama, ['IT', 'purchasing'])) {
            // Show all except status 'acc3' for IT or purchasing departments
            $beritas = BeritaAcara::with('penerima', 'pembuat')
                ->where('status', 'acc3')
                ->paginate(20);
        } elseif (BeritaAcara::where('penerima_id', Auth::id())->exists()) {
            // If the user is the penerima, show their BeritaAcara along with department-related ones
            $beritas = BeritaAcara::with('penerima', 'pembuat')
                ->where(function ($query) {
                    $query->where('penerima_id', Auth::id())
                        ->orWhereHas('penerima.department', function ($q) {
                            $q->where('pemimpin_id', Auth::id());
                        });
                })
                ->where('status', 'acc3')
                ->paginate(20);
        } elseif (
            BeritaAcara::whereHas('penerima.department', function ($query) {
                // If the user is a leader, show all BeritaAcara related to their department
                $query->where('pemimpin_id', Auth::id());
            })->exists()
        ) {
            $beritas = BeritaAcara::with('penerima', 'pembuat')
                ->whereHas('penerima.department', function ($query) {
                    $query->where('pemimpin_id', Auth::id());
                })
                ->where('status', 'acc3')
                ->paginate(20);
        } else {
            // If no matching BeritaAcara, return empty paginator
            $beritas = new LengthAwarePaginator([], 0, 20);
        }

        return view('bap-history', ['title' => $title, 'beritas' => $beritas]);
    }

    public function update(Request $request, $id)
    {
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
            $beritaacara = BeritaAcara::with('penerima', 'pembuat', 'detail_barang', 'pembelian', 'pengecekan')->findOrFail($id);
            if ($request->hasFile('gambar1')) {
                Storage::delete('public/' . $beritaacara->pengecekan->gambar1);
                $gambar1 = $request->file('gambar1');
                $gambar1Name = time() . '.' . $gambar1->getClientOriginalExtension();
                $gambar1Path = $request->file('gambar1')->storeAs('foto-bap', $gambar1Name, 'public');
                $beritaacara->pengecekan->foto1 = $gambar1Path;
            }

            if ($request->hasFile('gambar2')) {
                Storage::delete('public/' . $beritaacara->pengecekan->gambar2);
                $gambar2 = $request->file('gambar2');
                $gambar2Name = time() . '.' . $gambar2->getClientOriginalExtension();
                $gambar2Path = $request->file('gambar2')->storeAs('foto-bap', $gambar2Name, 'public');
                $beritaacara->pengecekan->foto2 = $gambar2Path;
            }

            $beritaacara->penerima_id = $validated['name'];

            $detail_barang = $beritaacara->detail_barang;
            $detail_barang->brand_id = $validated['brand'];
            $detail_barang->type_id = $validated['type'];
            $detail_barang->spesifikasi = $validated['spek'];
            $detail_barang->serial_number = $validated['serial'];
            $detail_barang->pc_name = $validated['pc_name'];
            $detail_barang->password = $validated['password'];
            $detail_barang->os_id = $validated['os'];
            $detail_barang->os_product_key = $validated['os_pk'];
            $detail_barang->office_id = $validated['office'];
            $detail_barang->office_product_key = $validated['office_pk'];
            $detail_barang->other = $validated['other'];
            $detail_barang->save();

            $pembelian = $beritaacara->pembelian;
            $pembelian->company_id = $validated['company'];
            $pembelian->pp = $validated['pp'];
            $pembelian->pp_date = $validated['tanggal_pp'];
            $pembelian->po = $validated['po'];
            $pembelian->po_date = $validated['tanggal_po'];
            $pembelian->sj = $validated['sj'];
            $pembelian->sj_date = $validated['tanggal_sj'];
            $pembelian->receipt_date = $validated['tanggal_rd'];
            $pembelian->save();

            $pengecekan = $beritaacara->pengecekan;
            $pengecekan->checker = $validated['checker'];
            $pengecekan->checking_date = $validated['tanggal_check'];
            $pengecekan->save();

            $beritaacara->pengecekan_date = now();
            $status = $beritaacara->status;
            if ($beritaacara->status === 'acc-1') {
                $beritaacara->status = 'acc0';
                $beritaacara->purchasing_date = null;
                $beritaacara->ttd_purchasing_id = null;
                $beritaacara->revisi_pembuat = null;
            } elseif ($beritaacara->status === 'acc-2') {
                $beritaacara->status = 'acc0';
                $beritaacara->purchasing_date = null;
                $beritaacara->using_date = null;
                $beritaacara->ttd_purchasing_id = null;
                $beritaacara->revisi_pembuat = null;
            } elseif ($beritaacara->status === 'acc-3') {
                $beritaacara->status = 'acc0';
                $beritaacara->purchasing_date = null;
                $beritaacara->using_date = null;
                $beritaacara->approved_date = null;
                $beritaacara->ttd_purchasing_id = null;
                $beritaacara->revisi_pembuat = null;
            }
            if ($status !== 'acc0') {
                $purchasing = User::whereHas('department', function ($query) {
                    $query->where('nama', 'purchasing');
                })->get();

                $msg = $beritaacara;
                $subject = "Pengajuan Berita Acara Pengakuan dan Penerimaan Aset";

                if ($purchasing->isNotEmpty()) {
                    foreach ($purchasing as $to) {
                        $email = $to->email;

                        if ($email) {
                            // Send email
                            Mail::to($email)->send(new AccBAPITkePurchasing($msg, $subject));
                        }
                    }
                }
            }
            $beritaacara->save();

            return back()->with('success', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function approveIndex($id)
    {
        $berita = BeritaAcara::with('penerima', 'pembuat', 'detail_barang', 'pembelian', 'pengecekan')->find($id);
        $title = 'Approval BAP';

        return view('bap-approve', ['berita' => $berita, 'title' => $title]);
    }

    public function approve($id)
    {
        $berita = BeritaAcara::with('penerima', 'pembuat', 'detail_barang', 'pembelian', 'pengecekan')->findOrFail($id);

        if (!$berita) {
            return redirect()->route('ongoing.bap')->with('error', 'Data not found.');
        }

        if ($berita->status === 'acc0') {
            $berita->status = 'acc1';
            $berita->ttd_purchasing_id = Auth::id();
            $berita->purchasing_date = now();
        } elseif ($berita->status === 'acc1') {
            $berita->status = 'acc2';
            $berita->using_date = now();
        } elseif ($berita->status === 'acc2') {
            $berita->status = 'acc3';
            $berita->approved_date = now();
        }

        $berita->save();

        if ($berita->status === 'acc1') {
            if ($berita->penerima->email) {
                $msg = $berita;
                $subject = "Pengajuan Berita Acara Pengakuan dan Penerimaan Aset";
                $email = $berita->penerima->email;

                if ($email) {
                    Mail::to($email)->send(new AccBAPPurchasingkeUser($msg, $subject));
                }
            }
        } elseif ($berita->status === 'acc2') {
            $msg = $berita;
            $subject = "Pengajuan Berita Acara Pengakuan dan Penerimaan Aset";
            $email = $berita->penerima->department->leader->email;

            if ($email) {
                Mail::to($email)->send(new AccBAPPurchasingkeUser($msg, $subject));
            }
        }

        if ($berita->pembuat->email) {
            $msg = $berita;
            $subject = "Update Approval Berita Acara Pengakuan dan Penerimaan Aset";
            $email = $berita->pembuat->email;

            Mail::to($email)->send(new NotifBAPIT($msg, $subject));
        }

        return redirect()->route('ongoing.bap')->with('success', 'Approval status updated successfully.');
    }


    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'revisi' => 'required|string'
        ]);

        $berita = BeritaAcara::with('penerima', 'pembuat', 'detail_barang', 'pembelian', 'pengecekan')->findOrFail($id);
        if ($berita->status === 'acc0') {
            $berita->status = 'acc-1';
            $berita->purchasing_date = now();
        } elseif ($berita->status === 'acc1') {
            $berita->status = 'acc-2';
            $berita->using_date = now();
        } elseif ($berita->status === 'acc2') {
            $berita->status = 'acc-3';
            $berita->approved_date = now();
        }

        if ($berita->pembuat->email) {
            $msg = $berita;
            $subject = "Update Approval Berita Acara Pengakuan dan Penerimaan Aset";
            $email = $berita->pembuat->email;

            Mail::to($email)->send(new NotifBAPIT($msg, $subject));
        }
        $berita->revisi_pembuat = $validated['revisi'];
        $berita->save();

        return redirect()->route('ongoing.bap')->with('success', 'Approval status updated successfully.');
    }

    public function printbap($id)
    {
        $bap = BeritaAcara::with('penerima', 'pembuat', 'detail_barang', 'pembelian', 'pengecekan')->find($id);
        $html = view('printbap', compact('bap'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $filePath = storage_path('app/public/bap.pdf');
        file_put_contents($filePath, $output);

        return $dompdf->stream($filePath, ['Attachment' => 0]);
    }
}
