<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;



class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment_body' => 'required'
        ]);

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

    public function edit($id){

        $comment = Comment::find($id);
        return view('Forumas.commentedit',compact('comment')); //->with('messages','id');
    }


    public function update(Request $request,$id){

        $this->validate($request, [
            'body' => 'required'
        ]);
        $comment = Comment::findOrFail($id);

        $body = $request->input('body');
        $comment->body = $body;

        $comment->save();
        return redirect()->route('Forumas.posts')->with('status','Patalpų informacija atnaujinta');
    }
}
