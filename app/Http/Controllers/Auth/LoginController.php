<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(){
        return view('auth.pages.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();


            if ($user->status === '1' && $user->hasRole('Super Admin')) {
                return redirect()->route('admin.home');
            } elseif ($user->status !== '1') {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Hesabınız aktiv deyil !']);
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Bu sayfaya erişim izniniz yok']);
            }
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Email ya da şifreniz yanlış!']);
    }

    public function logout(Request $request){
        if ((Auth::check()))
        {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
        };
    }

    public function showRegister(){
        return view('auth.pages.register');
    }

}
