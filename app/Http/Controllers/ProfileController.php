<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $userr = User::with('department')->find($id);
        $departments = Department::all();
        $isProfileIncomplete = empty($user->email) || empty($user->tahun_masuk) || empty($user->department_id) || empty($user->ttd);
        return view('profile', ['title' => "Profile", 'isProfileIncomplete' => $isProfileIncomplete, 'user' => $userr, 'departments' => $departments]);
    }

    public function updateProfile(Request $request)
{
    $credentials = $request->validate([
        'name' => 'required|max:255',
        'username' => [
            'required',
            'string',
        ],
        'email' => 'required|string',
        'jabatan' => 'required|string',
        'tahun_masuk' => 'required|date',
        'department_id' => 'required|string',
        'signature' => 'nullable|image|mimes:png|max:2048'
    ]);

    $id = Auth::user()->id;
    $user = User::find($id);

    // Check if a new signature file is uploaded
    if ($request->hasFile('signature')) {
        // If the user already has a signature, delete the old one
        if ($user->ttd) {
            Storage::delete('public/' . $user->ttd);
        }

        // Get the uploaded file
        $signature = $request->file('signature');

        // Generate a new file name with the current timestamp
        $signatureName = time() . '.' . $signature->getClientOriginalExtension();

        // Store the file with the custom name
        $filePath = $signature->storeAs('ttd', $signatureName, 'public');

        // Save the file path to the database
        $user->ttd = $filePath;
    }

    // Update the user's other details
    $user->name = $credentials['name'];
    $user->username = $credentials['username'];
    $user->email = $credentials['email'];
    $user->jabatan = $credentials['jabatan'];
    $user->tahun_masuk = $credentials['tahun_masuk'];
    $user->department_id = $credentials['department_id'];
    
    // Save the user data
    $user->save();

    // Redirect with a success message
    return redirect(route('profile'))->with('success', 'Update successful!');
}


    public function updatePassword(Request $request)
    {
        $credentials = $request->validate([
            'new_password' => 'required|min:8|max:255',
            'confirm_password' => 'required|min:8|max:255'
        ]);

        if ($request->new_password !== $request->confirm_password) {
            return back()->withErrors(['confirm_password' => 'The new password and confirm password do not match.']);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($credentials['new_password']);
        $user->save();
        return back()->with('status', 'Password successfully changed.');
    }
}
