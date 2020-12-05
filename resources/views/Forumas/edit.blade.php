@extends('layouts.app')

@section('content')
    <h1>Tema - {{$tema->pavadinimas}}</h1>
    <h3>Vartotojas sukūres temą - {{$tema->username}}</h3>
    <div class="col-md-8 offset-2">
        {!! Form::open(['action' => ['App\Http\Controllers\TopicsController@update',$tema->id], 'method'=>'POST']) !!}
        @csrf
        {{Form::hidden('_method','PATCH')}}

        <div class="form-group">
            {{Form::label('pavadinimas', 'Pavadinimas')}}
            {{Form::text('pavadinimas', $tema->pavadinimas, ['class' => 'form-control', 'placeholder' => 'Pavadinimas'])}}
        </div>
        <div class="form-group">
            {{Form::label('tekstas', 'Tekstas')}}
            {{Form::textarea('tekstas', $tema->tekstas, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Tekstas'])}}
        </div>




        {{Form::submit('Redaguoti', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>


@endsection
