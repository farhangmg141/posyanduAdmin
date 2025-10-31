<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAdmin;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = UserAdmin::latest()->paginate(10);
        return view('pages.useradmin.index', compact('users'));
    }

    public function create()
    {
        return view('pages.useradmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:user_admins',
            'role' => 'required|string',
            'password' => 'required|min:6',
        ]);

        UserAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('useradmin.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(UserAdmin $useradmin)
    {
        return view('pages.useradmin.edit', compact('useradmin'));
    }

    public function update(Request $request, UserAdmin $useradmin)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:user_admins,email,' . $useradmin->id,
            'role' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'role');
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $useradmin->update($data);

        return redirect()->route('useradmin.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(UserAdmin $useradmin)
    {
        $useradmin->delete();
        return redirect()->route('useradmin.index')->with('success', 'User berhasil dihapus!');
    }
}
