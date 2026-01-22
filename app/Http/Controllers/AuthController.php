<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulário de registo
    public function register()
    {
        return view('Auth.register');
    }

    // Processar o registo
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
        ]);




        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);



         return redirect()->intended('dashboard')->with('success', 'Login realizado com sucesso, ' . Auth::user()->name . '!');; // Vamos criar esta rota a seguir
    }

    // Mostrar formulário de login
    public function login()
    {
        return view('Auth.login');
    }

    // Processar o login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', ' realizado com sucesso, ' . Auth::user()->name . '!');
        }

       return back()->withErrors(['email' => 'Credenciais inválidas.'])->with('error', 'Ops! Algo deu errado.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
