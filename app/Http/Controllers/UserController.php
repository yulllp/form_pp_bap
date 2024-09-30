<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('department')->filter(request(['search']))->sortable()->latest()->paginate(20)->withQueryString();
        $departments = Department::all();
        return view('admin-users', ['title' => 'Admin - Users', 'users' => $users, 'departments' => $departments]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'role' => 'required|string'
        ]);

        try {
            $user = new User();
            $user->name = $validated['name'];
            $user->username = $validated['username'];
            $user->role = $validated['role'];
            $user->password = Hash::make('12345678');
            $user->save();

            return back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data.']);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => 'nullable|string|email|max:255',
            'jabatan' => 'nullable|string|max:255',
            'tahun_masuk' => 'nullable|date',
            'department_id' => 'nullable|string',
            'ttd' => 'nullable|image|mimes:png,jpeg,jpg|max:2048',
            'role' => 'required|string',
            'status' => 'required|string',
            'password' => 'nullable|string'
        ]);

        // dd($credentials['ttd']);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Check if a new signature file is uploaded
        if ($request->hasFile('ttd')) {
            // dd('masuk');
            // If the user already has a signature, delete the old one
            if ($user->ttd) {
                Storage::delete('public/' . $user->ttd);
            }

            // Get the uploaded file
            $signature = $request->file('ttd');

            // Generate a new file name with the current timestamp
            $signatureName = time() . '.' . $signature->getClientOriginalExtension();

            // Store the file with the custom name
            $filePath = $signature->storeAs('ttd', $signatureName, 'public');
            // Save the file path to the database
            $user->ttd = $filePath;
        }

        // Only update fields if they are not null
        if (!is_null($credentials['name'])) {
            $user->name = $credentials['name'];
        }

        if (!is_null($credentials['username'])) {
            $user->username = $credentials['username'];
        }

        if (!is_null($credentials['email'])) {
            $user->email = $credentials['email'];
        }

        if (!is_null($credentials['jabatan'])) {
            $user->jabatan = $credentials['jabatan'];
        }

        if (!is_null($credentials['tahun_masuk'])) {
            $user->tahun_masuk = $credentials['tahun_masuk'];
        }

        if (!is_null($credentials['department_id'])) {
            $user->department_id = $credentials['department_id'];
        }

        if (!is_null($credentials['password'])) {
            $user->password = $credentials['password'];
        }

        $user->role = $credentials['role'];
        $user->status = $credentials['status'];


        // Save the user data
        $user->save();

        // Redirect with a success message
        return back()->with('status', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('successdel', 'Delete successfull!');
    }
}
