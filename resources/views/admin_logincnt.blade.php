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
                                Prisijungimų kiekis: @php echo count($info); @endphp
                            </div>
                        </div>
                        <div class="ml-12">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>Šalis</th>
                                    <th>Įrenginys</th>
                                    <th>Naršyklė</th>
                                    <th>Data</th>
                                    <th>Ip</th>
                                    <th>Os</th>
                                </thead>
                                <tbody>
                                    @if (count($info) > 0)
                                    @foreach($info as $row)
                                    <tr>
                                        <td>{{$row->country}}</td>
                                        <td>{{$row->device}}</td>
                                        <td>{{$row->browser}}</td>
                                        <td>{{$row->date}}</td>
                                        <td>{{$row->ip}}</td>
                                        <td>{{$row->os}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>
                                            <div class="ml-4">
                                                <p style="font-size:1.2rem;margin-left:-24px">Prisijungimų nėra</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
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
