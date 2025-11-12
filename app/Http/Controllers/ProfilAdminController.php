<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfilAdminController extends Controller
{
    public function index()
    {
        // Ambil user login, kalau gak ada fallback ke user ID 1
        $user = Auth::user() ?? User::first();

        if (!$user) {
            abort(404, 'Data user tidak ditemukan.');
        }

        // Ambil profil user
        $profil = Profil::where('user_id', $user->id)->first();

        return view('pages.profilAdmin.index', compact('profil', 'user'));
    }

    public function edit()
    {
        $user = Auth::user() ?? User::first();

        if (!$user) {
            abort(404, 'Data user tidak ditemukan.');
        }

        // Pastikan profil user tersedia
        $profil = Profil::firstOrCreate(['user_id' => $user->id]);

        return view('pages.profilAdmin.edit', compact('profil', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user() ?? User::first();

        if (!$user) {
            abort(404, 'Data user tidak ditemukan.');
        }

        $request->validate([
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $profil = Profil::firstOrCreate(['user_id' => $user->id]);

        $data = [
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = public_path('uploads/profil');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            if ($profil->foto && File::exists($path . '/' . $profil->foto)) {
                File::delete($path . '/' . $profil->foto);
            }

            $file->move($path, $filename);
            $data['foto'] = $filename;
        }

        $profil->update($data);

        return redirect()->route('profilAdmin.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
