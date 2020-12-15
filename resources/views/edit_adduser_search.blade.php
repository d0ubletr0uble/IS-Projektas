@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-1">

                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg text-gray-200 leading-7 font-semibold">Grupės valdymo langas</div>
                    </div>
                    <div class="ml-xl-5">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            <ul>
                                @foreach($futurememb as $futurememb)
                                    <form action = "{{route('member.add',$id->id)}}" method="post">
                                        {{csrf_field() }}
                                        <li>{{$futurememb->username}}</li>
                                        <input type="hidden" name="futumemb_id" value={{$futurememb->id}} />
                                        <input type="hidden" name="futumemb_name" value={{$futurememb->username}} />
                                        <button type="submit" class="button2">Pridėti</button>
                                    </form>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
