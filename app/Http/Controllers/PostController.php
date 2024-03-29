<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    
    public function index(User $user) 
    {
        $posts = Post::where('user_id', $user->id)->paginate(10);

        return view('dashboard', ['user' => $user, 'posts' => $posts]);
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        /*
        // Otras maneras de almacenar valores
        // Creando un objeto y almacenando con save
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();

        // Creando un nuevo objeto en la relación del usuario
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);
        */

        return redirect()->route('posts.index', auth()->user());
    }

    public function show(User $user, Post $post) 
    {
        return view('posts.show', ['post' => $post, 'user' => $user]);
    }

    public function destroy(Post $post) 
    {
        $this->authorize('delete', $post);
        $post->delete();

        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user());      
    }
}
