<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    public function store(User $user, Request $request)
    {
        $user->followers()->attach($request->user()->id);

        return back();
    }

    public function destroy(User $user, Request $request)
    {
        $user->followers()->detach($request->user()->id);

        return back();
    }
}
