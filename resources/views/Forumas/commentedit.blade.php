@extends('layouts.app')

@section('content')
    <h1>Komentaro redagavimas</h1>

    <div class="col-md-8 offset-2">
        {!! Form::open(['action' => ['App\Http\Controllers\CommentController@update',$comment->id], 'method'=>'POST']) !!}
        @csrf
        {{Form::hidden('_method','PATCH')}}


        <div class="form-group">
            {{Form::label('body', 'Teksas')}}
            {{Form::textarea('body', $comment->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Tekstas'])}}
        </div>

        {{Form::submit('Redaguoti', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}<br>
        <a href="{{ route('Forumas.posts') }}" class="btn btn-primary">Grįžti atgal</a>
    </div>


@endsection
