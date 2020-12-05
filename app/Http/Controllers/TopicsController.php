<?php

namespace App\Http\Controllers;

use App\Models\topics;
use Illuminate\Http\Request;
use Auth;
class TopicsController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }



    public function submit(Request $request){


        $this->validate($request,[
            'pavadinimas' => 'required',
            'tekstas' => 'required'
        ]);

        $tema = new topics;
        $tema-> pavadinimas = $request->input('pavadinimas');
        $tema-> tekstas = $request->input('tekstas');
        $tema->user_id = Auth::user()->id;
        $tema->username = Auth::user()->username;


        $tema->save();

        return redirect()->route('Forumas.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tema = topics::all();

        return view('Forumas.forum') -> with('tema', $tema);
    }

    public function edit($id){

        $tema = topics::find($id);
        return view('Forumas.edit',compact('tema')); //->with('messages','id');
    }

    public function update(Request $request,$id){


        $tema = topics::findOrFail($id);

        $pavadinimas = $request->input('pavadinimas');
        $tekstas = $request->input('tekstas');
        $tema->pavadinimas = $pavadinimas;
        $tema->tekstas = $tekstas;

        $tema->save();
        return redirect()->route('Forumas.index')->with('status',' informacija atnaujinta');

    }

    public function destroy($id)
    {


        $tema = topics::findOrFail($id);

        $tema->delete();
        return redirect()->route('Forumas.index')->with('status','Pasirinkta patalpa ištrinta');
    }
}
