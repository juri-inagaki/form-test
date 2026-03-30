<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ログイン画面を表示
    public function loginForm()
    {
        return view('login'); // resources/views/login.blade.php を表示
    }

    // ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'メールアドレスかパスワードが間違っています'])->withInput();
    }

    // ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // 登録画面を表示
    public function registerForm()
    {
        return view('register'); // resources/views/register.blade.php
    }

    // 登録処理
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return redirect('/login');
    }
}