@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti temą</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('Forumas.poststore') }}">
                            <div class="form-group">
                                @csrf
                                <label class="label">Temos pavadinimas: </label>
                                <input type="text" name="title" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label class="label">Temos tekstas: </label>
                                <textarea name="body" rows="10" cols="30" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" />
                                <a href="{{ route('Forumas.posts') }}" class="btn btn-primary">Grįžti atgal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
