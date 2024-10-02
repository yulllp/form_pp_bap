<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class DepartmentController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        // dd($users);
        $departments = Department::with('leader')->filter(request(['search']))->sortable()->latest()->paginate(20);
        return view('admin-departments', ['title' => 'Admin - Departments', 'departments' => $departments, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'manager' => 'required|string'
        ]);

        try {
            $department = new Department();
            $department->nama = $validated['name'];
            $department->pemimpin_id = $validated['manager'];
            $department->save();
            return back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data.']);
        }
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'manager_id' => 'required|string',
            'status' => 'required|string'
        ]);

        $department = Department::findOrFail($id);
        $department->nama = $validated['name'];
        $department->pemimpin_id = $validated['manager_id'];
        $department->status = $validated['status'];
        $department->save();

        return back()->with('status', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return back()->with('successdel', 'Delete successfull!');
    }
}
