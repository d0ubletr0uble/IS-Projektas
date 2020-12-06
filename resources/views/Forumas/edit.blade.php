@extends('layouts.app')

@section('content')
    <h1>Temos -  {{$post->title}}  - redagavimas</h1>

    <div class="col-md-8 offset-2">
        {!! Form::open(['action' => ['App\Http\Controllers\PostController@update',$post->id], 'method'=>'POST']) !!}
        @csrf
        {{Form::hidden('_method','PATCH')}}

        <div class="form-group">
            {{Form::label('title', 'Pavadinimas')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Pavadinimas'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Teksas')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Tekstas'])}}
        </div>

        {{Form::submit('Redaguoti', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}<br>
        <a href="{{ route('Forumas.posts') }}" class="btn btn-primary">Grįžti atgal</a>
    </div>


@endsection
