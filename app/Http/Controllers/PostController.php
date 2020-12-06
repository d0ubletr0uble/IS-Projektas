<?php

// PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all();

        return view('Forumas.index', compact('posts'));
    }

    public function create()
    {
        return view('Forumas.post');
    }

    public function store(Request $request)
    {
        $post =  new Post;
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->username = Auth::user()->username;
        $post->save();

        return redirect()->route('Forumas.posts');

    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('Forumas.show', compact('post'));
    }

    public function edit($id){

        $post = Post::find($id);
        return view('Forumas.edit',compact('post')); //->with('messages','id');
    }


    public function update(Request $request,$id){

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        $post = Post::findOrFail($id);

        $title = $request->input('title');
        $body = $request->input('body');
        $post->title = $title;
        $post->body = $body;

        $post->save();
        return redirect()->route('Forumas.posts')->with('status','Patalpų informacija atnaujinta');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->route('Forumas.posts')->with('status','Pasirinkta patalpa ištrinta');
    }
}
