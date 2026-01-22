<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable',  'confirmed', Password::defaults()],
        ]);

        // Atualizar nome e email
        $user->name = $data['name'];
        $user->email = $data['email'];

        // Atualizar senha se fornecida
        if ($request->filled('new_password')) {
            if (!Hash::check($data['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
            }
            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
