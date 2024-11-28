<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function regisForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);


        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login.form');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email:dns',
                'password' => 'required|',
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'email.required' => 'Email Wajib Diisi',
                'password.required' => 'Password Wajib Diisi',
                'email.email' => 'Email Tidak Valid',
                'g-recaptcha-response.required' => 'Verifikasi Captcha Wajib Diisi',
                'g-recaptcha-response.captcha' => 'Verifikasi Captcha Gagal',
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            toastr('Login Berhasil Dilakukan!.');
            Cookie::queue('remember_me', Auth::id(), 5); 
            return redirect()->route($this->getRedirectRoute(Auth::user()->role));
        } else {
            toastr()->error('Login Gagal!');
            return redirect()->route('login');
        }
    }

    private function getRedirectRoute($role)
    {
        $routes = [
            'admin' => 'admin',
            'petugas' => 'admin',
            'peminjam' => 'home',
        ];

        return $routes[$role];
    }

    public function logout()
    {
        Auth::logout();
        Cookie::queue(Cookie::forget('remember_me'));
        return redirect()->route('login.form');
    }
}
