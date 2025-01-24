<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class signupController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'email'                 => 'required|email|unique:users',
                'name'                  => 'required|string|max:255',
                'password'              => 'required|string|min:8|max:10',
                'password_confirmation' => 'required|string|min:8|max:10',
            ],
            [
                // Pesan error untuk email
                'email.required'                 => 'Email wajib diisi.',
                'email.email'                    => 'Masukkan email yang valid.',
                'email.unique'                   => 'Email sudah terdaftar.',
                // Pesan error untuk name
                'name.required'                  => 'Nama wajib diisi.',
                'name.string'                    => 'Nama harus berupa teks.',
                'name.max'                       => 'Nama tidak boleh lebih dari 255 karakter.',
                // Pesan error untuk password
                'password.required'              => 'Password wajib diisi.',
                'password.string'                => 'Password harus berupa teks.',
                'password.min'                   => 'Password harus memiliki minimal 8 karakter.',
                'password.max'                   => 'Password tidak boleh lebih dari 10 karakter.',
                // Pesan error untuk konfirmasi password
                'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
                'password_confirmation.string'   => 'Konfirmasi password harus berupa teks.',
                'password_confirmation.min'      => 'Konfirmasi password harus memiliki minimal 8 karakter.',
                'password_confirmation.max'      => 'Konfirmasi password tidak boleh lebih dari 10 karakter.',
            ]
        );

        // Memeriksa apakah password dan konfirmasi password cocok
        if ($request->input('password') !== $request->input('password_confirmation')) {
            // Jika tidak cocok, kembalikan error
            throw ValidationException::withMessages([
                'password_confirmation' => ['Password tidak cocok.'],
            ]);
        }
        // Membuat user baru
        User::create([
            'email'    => $request->input('email'),
            'name'     => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'role'     => 'user',
        ]);

        // Redirect ke halaman login setelah sukses sign up
        return redirect()->intended('/')->with('success', 'Account created successfully! Please login.');
    }
}
