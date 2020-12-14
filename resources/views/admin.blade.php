@extends('layouts.app_admin')
@section('content')
@if(auth()->user()->is_admin == 1)

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-2 md:grid-cols-1">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4">
                                Administratoriaus vartotojų parinkimo langas
                            </div>
                        </div>
                        <div class="ml-12">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Vardas</th>
                                    <th>Pavardė</th>
                                    <th>Gimtadienis</th>
                                    <th>Slapyvardis</th>
                                    <th>El.Paštas</th>
                                    <th>Blokuoti/Atblokuoti</th>
                                    <th>Statistika</th>
                                    <th>Prisijungimai/Kiekis</th>
                                    <th>Išsiųstos žinutės/Kiekis</th>
                                </thead>
                                <tbody>
                                    @foreach($users as $row)
                                    <tr>
                                        @if($row->is_blocked == 0)
                                        <td class="notblocked">{{$row->id}}</td>
                                        <td class="notblocked">{{$row->first_name}}</td>
                                        <td class="notblocked">{{$row->last_name}}</td>
                                        <td class="notblocked">{{$row->birthday}}</td>
                                        <td class="notblocked">{{$row->username}}</td>
                                        <td class="notblocked">{{$row->email}}</td>
                                        @if($row->is_blocked == 0)
                                        <td class="notblocked">
                                            <a href="{{route('admin_block', $row->id)}}" class="btn btn-primary"
                                                onclick="return confirm('Ar tikrai norite užblokuoti?')"> <i
                                                    class="fas fa-user-slash if"></i>
                                            </a>
                                        </td>

                                        @else
                                        <td class="notblocked">
                                            <a href="{{route('admin_unblock', $row->id)}}" class="btn btn-primary">
                                                <i class="fas fa-user if"></i></a>
                                        </td>

                                        @endif
                                        <td class="notblocked">
                                            <a href="{{route('admin_statistics', $row->id)}}" class="btn btn-primary"><i
                                                    class="fas fa-info-circle ic"></i></a>
                                        </td>

                                        <td class="notblocked">
                                            <a href="{{route('admin_logincnt', $row->id)}}" class="btn
                                            btn-primary">
                                                <i class="far fa-address-book ic"></i>
                                            </a>
                                        </td>

                                        <td class="notblocked">
                                            <a href="{{route('admin_sentmesg', $row->id)}}" class="btn btn-primary"><i
                                                    class="far fa-comment-dots il"></i></a>
                                        </td>

                                        @else
                                        <td class="blocked">{{$row->id}}</td>
                                        <td class="blocked">{{$row->first_name}}</td>
                                        <td class="blocked">{{$row->last_name}}</td>
                                        <td class="blocked">{{$row->birthday}}</td>
                                        <td class="blocked">{{$row->username}}</td>
                                        <td class="blocked">{{$row->email}}</td>
                                        @if($row->is_blocked == 0)
                                        <td class="blocked">
                                            <a href="{{route('admin_block', $row->id)}}" class="btn btn-primary"> <i
                                                    class="fas fa-user-slash if"></i>
                                            </a>
                                        </td>

                                        @else
                                        <td class="blocked">
                                            <a href="{{route('admin_unblock', $row->id)}}" class="btn btn-primary">
                                                <i class="fas fa-user if"></i></a>
                                        </td>

                                        @endif
                                        <td class="blocked">
                                            <a href="{{route('admin_statistics', $row->id)}}" class="btn btn-primary"><i
                                                    class="fas fa-info-circle ic"></i></a>
                                        </td>

                                        <td class="blocked">
                                            <a href="{{route('admin_logincnt', $row->id)}}" class="btn btn-primary">
                                                <i class="far fa-address-book ic"></i>
                                            </a>
                                        </td class="blocked">

                                        <td class="blocked">
                                            <a href="{{route('admin_sentmesg', $row->id)}}" class="btn btn-primary"><i
                                                    class="far fa-comment-dots il"></i></a>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                        </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endif

@endsection
