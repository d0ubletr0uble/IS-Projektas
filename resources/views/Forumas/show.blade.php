@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p>Temos pavadinimas - <b>{{ $post->title }}</b></p>
                        <p>Vartotojas - <b>{{ $post->username }}</b></p>
                        <p>
                            Tekstas: <br>{{ $post->body }}
                        </p>
                        <hr />
                        <h4>Visi komentarai:</h4>
                        @foreach($post->comments as $comment)
                            <div class="display-comment">
                                Vartotojas: <strong>{{ $comment->user->username }}</strong>
                                <p>Komentaras: <br>{{ $comment->body }}</p>
                            </div>
                            <td>
                                @if(Auth::user()->id == $comment->user_id)
                                <a> {!! Form::open(['action' => ['App\Http\Controllers\CommentController@destroy',$comment->id], 'method'=>'POST']) !!}
                                    @csrf
                                    {{Form::hidden('_method','DELETE')}}

                                    {{Form::submit('Ištrinti', ['class'=>'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </a>
                                    @endif
                            </td>
                            <hr />
                        @endforeach
                        <hr />
                        <h4>Pridėti komentarą</h4>
                        <form method="post" action="{{ route('Forumas.commentadd') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment_body" class="form-control" />
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Pridėti komentarą" />
                                <a href="{{ route('Forumas.posts') }}" class="btn btn-primary">Grįžti atgal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
