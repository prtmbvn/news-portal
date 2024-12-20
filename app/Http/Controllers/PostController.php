<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::with('tags', 'category')->latest()->paginate(10);

        return view('page.posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('tags')->findOrFail($id);

        return view('page.posts.show', compact('post'));
    }

    public function blog()
    {
        $posts = Post::with('category', 'user')->latest()->paginate(10);

        return view('page.blog', compact('posts'));
    }

    
}
