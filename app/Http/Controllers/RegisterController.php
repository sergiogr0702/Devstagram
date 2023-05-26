<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        // Se modifica el username en el request
        // Slug permite que el username no tenga espacios, acentos ni mayusculas
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validacion de datos del formuario
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6|max:30',
        ]);
        
        // Creacion de usuario
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autenticacion del usuario
        /*
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        */

        // Autenticacion del usuario
        auth()->attempt($request->only('email', 'password'));

        // Redireccionamiento
        return redirect()->route('posts.index');
    }
}
