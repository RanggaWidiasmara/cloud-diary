<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DiaryEntry;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        // 1. Bikin User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // 2. Langsung Login-kan User
        Auth::login($user);

        // 3. LOGIC GUEST MODE: Tangkap curhatan yang ngegantung di Session
        if (session()->has('pending_guest_curhatan')) {
            // Simpan ke Database untuk User yang baru aja login
            DiaryEntry::create([
                'user_id' => $user->id,
                'content' => session('pending_guest_curhatan'),
                'cloud_type' => session('pending_guest_awan'),
                'ai_suggestion' => session('pending_guest_saran'),
            ]);

            // Bersihkan sampah Session biar nggak ke-submit dobel nantinya
            session()->forget([
                'has_tried_guest',
                'pending_guest_curhatan',
                'pending_guest_awan',
                'pending_guest_saran'
            ]);

            // Redirect ke halaman utama dengan pesan manis
            return redirect()->route('home')->with('success', 'Selamat datang! Awan pertamamu berhasil disimpan dengan aman. ☁️');
        }

        // Kalau dia daftar normal (bukan dari Guest Mode), langsung lempar ke Home
        return redirect()->route('home');
    }
}
