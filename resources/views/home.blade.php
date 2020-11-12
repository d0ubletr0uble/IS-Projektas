@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        <p class="card-text h4"> User data:</p>
                    </div>
                    <div class="container">
                        <table class="table table-bordered">
                            <tbody>
                            @foreach($user->getAttributes() as $key => $value)
                                <tr>
                                    <th scope="row">{{$key}}</th>
                                    <td>{{$value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold"><a href="/profile_edit" class="underline text-gray-900 dark:text-white">Redaguoti profilį</a></div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold"><a href="/profile_devices" class="underline text-gray-900 dark:text-white">Prijungti įrenginiai</a></div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold"><a href="/profile_visitors" class="underline text-gray-900 dark:text-white">Profilio lankytojai</a></div>
                    </div>
                    <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold"><a href="/profile_status" class="underline text-gray-900 dark:text-white">Būsena</a></div>
                    </div>
                </div>    
                         
                </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
