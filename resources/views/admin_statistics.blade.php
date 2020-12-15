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
                                Vartotojo statistika
                            </div>
                            {{-- mesg --}}
                            <hr style="border-top: 5px solid orange;">
                            <p class="text-md-center" style="font-weight: 500">Išsiųstų žinučių tipai/kiekiai</p>
                            <hr style="border-top: 1px solid orange;">

                            @if (count($mesg_count) > 0)
                            @foreach($mesg_count as $row)
                            <p class="text-md-center">Išsiųstų {{$row->type}} tipo žinučių kiekis: {{$row->num}}</p>
                            @endforeach
                            @else
                            <p class="text-md-center">Nerasta išsiųstų žinučių</p>
                            @endif
                            {{-- ip --}}
                            <hr style="border-top: 5px solid orange;">
                            <p class="text-md-center" style="font-weight: 500">IP adresai/kiekiai</p>
                            <hr style="border-top: 1px solid orange;">

                            @if (count($ip_count) > 0)
                            @foreach($ip_count as $row)
                            <p class="text-md-center">IP: {{$row->ip}} kiekis: {{$row->num}}</p>
                            @endforeach
                            @else
                            <p class="text-md-center">Nerasta IP adresų</p>
                            @endif
                            {{-- devices --}}
                            <hr style="border-top: 5px solid orange;">
                            <p class="text-md-center" style="font-weight: 500">Naudoti įrenginiai/kiekiai</p>
                            <hr style="border-top: 1px solid orange;">

                            @if (count($device_count) > 0)
                            @foreach($device_count as $row)
                            <p class="text-md-center">Įrenginys: {{$row->device}} kiekis: {{$row->num}}</p>
                            @endforeach
                            @else
                            <p class="text-md-center">Nerasta įrenginių</p>
                            @endif
                            {{-- search --}}
                            <hr style="border-top: 5px solid orange;">
                            <p class="text-md-center" style="font-weight: 500">Paieška</p>
                            <hr style="border-top: 1px solid orange;">

                            @if (count($searches) > 0)
                            @foreach($searches as $row)
                            <div class="container">
                                <div class="row row-cols-auto text-md-center">
                                    <div class="col" style="white-space: normal; position:relative;margin-left:40%; ">
                                        <span
                                            style="display:block;width:150px;word-wrap:break-word;">{{$row->search_info}}</span>
                                    </div>
                                    <div class="col" style="white-space: normal;  ">{{$row->date}}</div>
                                </div>
                            </div>
                            <hr style="border-top: 1px solid rgb(10, 220, 10); ">
                            @endforeach
                            @else
                            <p class="text-md-center">Nerasta paieškos rezultatų</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
@endif

@endsection
