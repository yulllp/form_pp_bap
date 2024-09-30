<?php

namespace App\Http\Controllers;

use App\Models\PtTujuan;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = PtTujuan::filter(request(['search']))->sortable()->latest()->paginate(20);
        return view('admin-companies', ['title' => 'Admin - Companies', 'companies' => $companies]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        // dd($validated['name']);
        try {
            $company = new PtTujuan();
            $company->name = $validated['name'];
            // dd($company->nama);
            $company->save();
            // dd('tersimpan');
            return back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data.']);
        }
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|string'
        ]);

        $company = PtTujuan::findOrFail($id);
        $company->name = $validated['name'];
        $company->status = $validated['status'];
        $company->save();

        return back()->with('status', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $company = PtTujuan::findOrFail($id);
        $company->delete();
        return back()->with('successdel', 'Delete successfull!');
    }
}
