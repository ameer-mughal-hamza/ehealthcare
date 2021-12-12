<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user'])->get();
        $display = [
            'title' => '',
            'posts' => $posts
        ];
        return view('/admin/posts/index')->with($display);
    }

    public function show($id)
    {
        $post = Post::with([
            'user',
            'comments',
            'likes'
        ])->where('id', $id)->first();

        $display = [
            'title' => '',
            'post' => $post
        ];

        return view('admin/posts/show')->with($display);
    }
}
