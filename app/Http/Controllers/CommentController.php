<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;



class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();
        return redirect()->route('Forumas.posts')->with('status','Pasirinkta patalpa ištrinta');
    }
}
