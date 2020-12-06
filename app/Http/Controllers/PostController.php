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
        $post->name = Auth::user()->name;
        $post->save();

        return redirect('Forumas.posts');

    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('show', compact('post'));
    }

    public function edit($id){

        $post = Post::find($id);
        return view('Forumas.postedit',compact('post')); //->with('messages','id');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->route('Forumas.posts')->with('status','Pasirinkta patalpa ištrinta');
    }
}
