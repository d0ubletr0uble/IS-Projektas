@extends('layouts.app')

@section('content')
    <h1>Tema - {{$tema->pavadinimas}}</h1>
    <h3>Vartotojas sukūres temą - {{$tema->username}}</h3>
    <div class="col-md-8 offset-2">
        {!! Form::open(['action' => ['App\Http\Controllers\TopicsController@update',$tema->id], 'method'=>'POST']) !!}
        @csrf
        {{Form::hidden('_method','PATCH')}}
        <div class="form-group">
            {{Form::label('vardas', 'Pavadinimas')}}
        </div>
        <div class="form-group">
            {{Form::label('vardas', 'Pavadinimas')}}
            {{Form::text('vardas', $tema->pavadinimas, ['class' => 'form-control', 'placeholder' => 'Vardas'])}}
        </div>
        <div class="form-group">
            {{Form::label('media', 'Media')}}
            {{Form::textarea('media', $tema->tekstas, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Media'])}}
        </div>




        {{Form::submit('Redaguoti', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>


@endsection
