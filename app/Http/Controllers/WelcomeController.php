<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class WelcomeController extends Controller
{
    public function show()
    {
        $posts = Post::all()->take(6)->sortByDesc('created_at');

        return view('welcome', ['posts' => $posts]);
    }
}
