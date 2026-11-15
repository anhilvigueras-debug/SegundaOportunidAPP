<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function mostrarRegistro()
    {
        return view('usuarios.registro');
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:15',
            'ciudad'   => 'nullable|string|max:100',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/'
            ],
        ], [
            'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.',
        ]);

        $usuario = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'ciudad'   => $request->ciudad,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($usuario);

        return redirect()->route('perfil')->with('success', '¡Cuenta creada correctamente!');
    }

    public function mostrarLogin()
    {
        return view('usuarios.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'loginEmail'    => 'required|email',
            'loginPassword' => 'required|string',
        ], [
            'loginEmail.required'    => 'El campo correo electrónico es obligatorio.',
            'loginEmail.email'       => 'Ingresa un correo electrónico válido.',
            'loginPassword.required' => 'El campo contraseña es obligatorio.',
        ]);

        if (Auth::attempt(['email' => $request->loginEmail, 'password' => $request->loginPassword])) {
            $request->session()->regenerate();
            return redirect()->intended(route('perfil'));
        }

        return back()->withErrors([
            'loginEmail' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('loginEmail');
    }

    public function mostrarPerfil()
    {
        $usuario = Auth::user();
        return view('usuarios.perfil', compact('usuario'));
    }

    public function actualizarPerfil(Request $request)
    {
        /** @var \App\Models\User $usuario */
        $usuario = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'ciudad'   => 'nullable|string|max:100',
        ]);

        $usuario->update([
            'name'     => $request->name,
            'telefono' => $request->telefono,
            'ciudad'   => $request->ciudad,
        ]);

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
