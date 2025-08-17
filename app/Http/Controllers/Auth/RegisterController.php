<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'nama_lengkap'  => 'required|string|max:255',
            'foto_profil'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'nik'           => 'required|string|max:16',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:15',
            'pekerjaan'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|confirmed|min:6',
            'foto_ktp'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $fileName = null;
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/profil', $fileName);
        }

        $fileName = null;
        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/ktp', $fileName);
        }

        // simpan user
        User::create([
            'name'          => $request->name,
            'nama_lengkap'  => $request->nama_lengkap,
            'foto_profil'      => $fileName,
            'nik'           => $request->nik,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'pekerjaan'     => $request->pekerjaan,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'foto_ktp'      => $fileName,
            'role'          => 'user',
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
