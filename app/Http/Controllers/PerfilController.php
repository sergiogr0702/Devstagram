<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('perfil.index', ['user' => auth()->user()]);
    }

    public function store(Request $request)
    {
        // Se modifica el username en el request
        // Slug permite que el username no tenga espacios, acentos ni mayusculas
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20',
                'not_in:admin,root,administrator,superuser,super,twitter,instagram,facebook,editar-perfil,posts,login,register,logout,imagenes'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:60'],
            'password' => 'required|min:6|max:30',
            'new_password' => 'nullable|min:6|max:30',
        ]);

        if(!auth()->attempt(['id' => auth()->user()->id, 'password' => $request->password])) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        if($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->email = $request->email;

        if($request->new_password) {
            $usuario->password = Hash::make($request->new_password);
        }

        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';

        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
