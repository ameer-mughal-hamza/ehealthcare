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
        return Post::with(['user', 'comments', 'comments.user'])->get()->map(function ($query) {
            $query->setRelation('comments', $query->comments->take(3));
            return $query;
        });
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:5000'
        ]);

        $comment = new Comment;
        $comment->description = $request->get('comment');
        $comment->user()->associate(User::find(4));
        $post = Post::find($request->post_id);
        $post->comments()->save($comment);

        event(new PostEvent($comment));

        return $comment;
    }

    public function show($slug)
    {
        return Post::with(['user', 'comments', 'comments.user'])->where([
            'id' => $slug
        ])->first();
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
