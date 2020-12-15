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
                                Išsiųstų žinučių kiekis: @php echo count($messages); @endphp
                            </div>
                        </div>
                        <div class="ml-12">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>Žinutės turinys</th>
                                    <th>Tipas</th>
                                    <th>Išsiųsta</th>
                                </thead>
                                <tbody>
                                    @foreach($messages as $row)
                                    <tr>
                                        <td>{{$row->content}}</td>
                                        <td>{{$row->type}}</td>
                                        <td>{{$row->created_at}}</td>
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
