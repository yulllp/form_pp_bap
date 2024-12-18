<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\PermintaanPembelian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OngoingController extends Controller
{
    public function index()
    {
        $user = User::with(['department'])->find(Auth::id());
        $leaders = Department::pluck('pemimpin_id')->toArray();
        $leader_id = Department::where('nama', 'IT')->pluck('pemimpin_id')->first();

        if (Auth::user()->department->nama != 'IT' && Auth::user()->id != Auth::user()->department->leader->id) {
            $data = PermintaanPembelian::with('pt_tujuan', 'approval')->whereNot('status', 'acc2')->where('user_id', Auth::user()->id)->latest()->paginate(20);
        } elseif (Auth::user()->department->nama == 'IT' && !(in_array(Auth::id(),$leaders))) {
            $data = PermintaanPembelian::with('pt_tujuan', 'approval')->whereIn('status', ['acc0', 'acc-2', 'acc-1', 'acc1'])->latest()->paginate(20);
        } 
        elseif (in_array(Auth::id(),$leaders) && Auth::user()->department->nama != 'IT') {
            $data = PermintaanPembelian::with('pt_tujuan', 'user', 'approval')
                ->whereIn('status', ['acc0', 'acc-2', 'acc-1', 'acc1'])
                ->whereHas('user', function ($query) use ($user) {
                    $query->where('department_id', $user->department_id);
                })
                ->latest()
                ->paginate(20);
        }
        elseif ($leader_id == Auth::id() && Auth::user()->department->nama == 'IT') {
            $data = PermintaanPembelian::with('pt_tujuan', 'approval')->whereIn('status', ['acc0', 'acc-2', 'acc-1', 'acc1'])->latest()->paginate(20);
        }
        return view('ongoing', ['title' => 'On Going', 'datas' => $data, 'leaders' => $leaders]);
    }
}