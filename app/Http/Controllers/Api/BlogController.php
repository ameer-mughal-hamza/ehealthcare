<?php

namespace App\Http\Controllers\Api;

use App\Events\PostEvent;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        return Post::with(['user', 'comments', 'comments.user'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|max:3'
        ]);
        $comment = new Comment;
        $comment->description = $request->get('comment');
        $comment->user()->associate(1);
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        event(new PostEvent($request->get('comment'), User::find(1)));

        return $comment;
    }

    public function show($slug)
    {
//        $post = Post::with(['user', 'comments', 'comments.user'])->where([
//            'id' => $slug
//        ])->first();
//        dd($post);
        return Post::with(['user', 'comments', 'comments.user'])->where([
            'id' => $slug
        ])->first();
//        return Post::active()->where('slug', $slug)->first();
    }

    public function update(Request $request, $id)
    {
        return Post::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
    }

    public function destroy($slug)
    {
        // Return no. of records deleted
        return Post::where('slug', $slug)->delete();
    }
}
