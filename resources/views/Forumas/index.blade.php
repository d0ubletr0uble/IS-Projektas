@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                    <th>Temos nr</th>
                    <th>Pavadinimas</th>
                    <th>Vartotojas</th>
                    <th>Veiksmai</th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->username }}</td>
                            <td>
                                <a href="{{ route('Forumas.postshow', $post->id) }}" class="btn btn-primary">Rodyti temą</a>
                            </td>
                            <td>
                                <a> {!! Form::open(['action' => ['App\Http\Controllers\PostController@destroy',$post->id], 'method'=>'POST']) !!}
                                    @csrf
                                    {{Form::hidden('_method','DELETE')}}

                                    {{Form::submit('Ištrinti', ['class'=>'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
