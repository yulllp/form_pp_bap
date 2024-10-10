<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index(){
        $title = 'Admin - Office';
        $brands = Office::filter(request(['search']))->sortable()->latest()->paginate(20)->withQueryString();

        return view('admin-office', ['title' => $title, 'brands' => $brands]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        // dd($validated['name']);
        try {
            $brand = new Office();
            $brand->name = $validated['name'];
            // dd($company->nama);
            $brand->save();
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

        $company = Office::findOrFail($id);
        $company->name = $validated['name'];
        $company->status = $validated['status'];
        $company->save();

        return back()->with('status', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $company = Office::findOrFail($id);
        $company->delete();
        return back()->with('successdel', 'Delete successfull!');
    }
}
