<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman Login & Register
     */
    public function showLoginRegister()
    {
        return view('auth.login');
    }

    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Menggunakan route('admin.dashboard') lebih disarankan
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil! Mengalihkan...',
                'redirect' => route('admin.dashboard')
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah'
        ], 401);
    }

    /**
     * Proses Register
     */
  public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ], [
        'name.required' => 'Nama harus diisi',
        'email.required' => 'Email harus diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password harus diisi',
        'password.min' => 'Password minimal 8 karakter',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Simpan user baru
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Auto login setelah register
    Auth::login($user);
    $request->session()->regenerate();

    // Arahkan ke dashboard (bukan admin.dashboard)
    return response()->json([
        'success' => true,
        'message' => 'Registrasi berhasil! Mengalihkan...',
        'redirect' => route('admin.dashboard')
    ], 201);
}


    
     
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Proses Lupa Password (kirim email reset)
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.']);
        }

        // Buat token
        $token = Str::random(60);

        // Simpan token ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        // Kirim email
        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        Mail::raw("Klik link berikut untuk mereset password Anda: " . $resetLink, function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Link Reset Password Anda');
        });

        return back()->with('status', 'Kami telah mengirimkan link reset password ke email Anda!');
    }

    /**
     * Menampilkan form untuk mereset password.
     */
    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    /**
     * Memproses dan menyimpan password baru.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resetRecord = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        $user = User::where('email', $request->email)->first();

        if (!$resetRecord || !$user || !Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['email' => 'Token reset password tidak valid atau email salah.']);
        }
        
        // Cek apakah token sudah kadaluarsa (misal > 60 menit)
        if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Token reset password telah kadaluarsa.']);
        }

        // Update password user
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token dari database
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login.show')->with('status', 'Password Anda telah berhasil diubah!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }
}