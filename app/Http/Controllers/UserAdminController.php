<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
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
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('useradmin.index')
                         ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $useradmin)
    {
        return view('pages.useradmin.edit', compact('useradmin'));
    }

    public function update(Request $request, User $useradmin)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $useradmin->id,
            'role' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'role');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $useradmin->update($data);

        return redirect()->route('useradmin.index')
                         ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $useradmin)
    {
        $useradmin->delete();

        return redirect()->route('useradmin.index')
                         ->with('success', 'User berhasil dihapus!');
    }
}
