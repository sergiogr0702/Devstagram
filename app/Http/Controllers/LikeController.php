<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // De esta manera se crea un like desde la relacion de los posts
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        /*
        // De esta manera se elimina un like desde la relacion de los posts
        $post->likes()->where('user_id', $request->user()->id)->delete();
        */

        // De esta manera se elimina un like desde la relacion de los usuarios
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
