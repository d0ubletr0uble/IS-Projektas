@extends('layouts.app')

@section('content')


    <form action="/forum/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q"
                   placeholder="Surasti temą įvedant temos pavadinimą arba vartotojo slapyvardi"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
        </div>
    </form>
    <div class="container">
        @if(isset($details))
            <p> Paieškos <b> {{ $query }} </b> rezultatai yra :</p>
            <h2>Vartotojo informacija</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Temos pavadinimas</th>
                    <th>Vartotojo slapyvardis</th>
                </tr>
                </thead>
                <tbody>
                @foreach($details as $user)
                    <tr>
                        <td>{{$user->title}}</td>
                        <td>{{$user->username}}</td>
                        <td>
                            <a href="{{ route('Forumas.postshow', $user->id) }}" class="btn btn-primary">Rodyti temą</a>
                        </td>
                    </tr>


                @endforeach
                </tbody>
            </table>

            <div class="form-group">

                <a href="{{ route('Forumas.posts') }}" class="btn btn-primary">Grįžti atgal</a>
            </div>
        @endif
    </div>
@endsection
