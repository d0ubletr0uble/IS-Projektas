<?php

namespace App\Http\Controllers;

use App\Models\Temos;
use Illuminate\Http\Request;

class TemosController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function submit(Request $request){


        $this->validate($request,[
            'pavadinimas' => 'required',
            'tekstas' => 'required'
        ]);

        $tema = new temos;
        $tema-> pavadinimas = $request->input('pavadinimas');
        $tema-> tekstas = $request->input('tekstas');


        $tema->save();

        return redirect('/')->with('status','Pridėtos naujos patalpos');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tema = temos::all();

        return view('Forumas.forum') -> with('tema', $tema);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temos  $temos
     * @return \Illuminate\Http\Response
     */
    public function show(Temos $temos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Temos  $temos
     * @return \Illuminate\Http\Response
     */
    public function edit(Temos $temos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Temos  $temos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temos $temos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temos  $temos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temos $temos)
    {
        //
    }
}
