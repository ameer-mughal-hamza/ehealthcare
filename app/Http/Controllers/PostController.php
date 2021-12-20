<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\False_;

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
            'title' => 'Post | ' . Str::limit($post->description, 55),
            'post' => $post,
            'authUser' => auth()->check() ? auth()->user() : false
        ];

        return view('landing-page/posts/show')->with($display);
    }
}
