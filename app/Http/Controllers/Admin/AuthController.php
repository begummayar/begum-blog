<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('home');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        $username = (string) config('admin.username', '');
        $password = (string) config('admin.password', '');

        $usernameMatches = $username !== ''
            && hash_equals($username, $credentials['username']);

        $passwordMatches = $password !== ''
            && hash_equals($password, $credentials['password']);

        if (!$usernameMatches || !$passwordMatches) {
            throw ValidationException::withMessages([
                'username' => 'Kullanıcı adı veya şifre hatalı.',
            ]);
        }

        $request->session()->regenerate();
        $request->session()->put('admin_logged_in', true);

        return redirect()
            ->route('home')
            ->with('success', 'Yönetici girişi başarılı.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Başarıyla çıkış yaptınız.');
    }
}
