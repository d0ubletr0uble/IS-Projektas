<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset('css/admin.css')?>" type="text/css">
</head>

@if(auth()->user()->is_admin == 1)

<body class="antialiased">
    <div class="ml-4 text-lg leading-7 font-semibold">Admin page</div>
    <div class="ml-4 text-lg leading-7 font-semibold"><a href="/"
            class="underline text-gray-900 dark:text-black">Home</a></div>

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-2 md:grid-cols-1">

                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lgg text-gray-200 leading-7 font-semibold">
                                Administratoriaus vartotojų parinkimo langas
                            </div>
                        </div>
                        <div class="ml-12">
                            <table class="table">
                                <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Last name</th>
                                    <th>Birthday</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                </thead>
                                <tbody>
                                    @foreach($users as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->first_name}}</td>
                                        <td>{{$row->last_name}}</td>
                                        <td>{{$row->birthday}}</td>
                                        <td>{{$row->username}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>
                                            <a href="#" class="btn btn-success">Action</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success">Action</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success">Action</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success">Action</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </div>
                        </table>

                        {{-- <div class="ml-12">
                            <div class="mt-2 text-red text-lg">
                                • Vartotojas1
                                <i class="fas fa-user"></i>
                                <a href="/admin/unblock" class="underline text-gray-900 dark:text-white">Unblock</a>
                                <i class="fas fa-info-circle"></i>
                                <a href="/admin/statistics"
                                    class="underline text-gray-900 dark:text-white">Statistics</a>
                                <i class="far fa-address-book"></i>
                                <a href="/admin/logincnt" class="underline text-gray-900 dark:text-white">Login
                                    count</a>
                                <i class="far fa-comment-dots"></i>
                                <a href="/admin/sentmesg" class="underline text-gray-900 dark:text-white">Messages</a>
                            </div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 dark:text-gray-400 text-lg">
                                • Vartotojas2
                                <i class="fas fa-user-slash"></i>
                                <a href="/admin/block" class="underline text-gray-900 dark:text-white">Block</a>
                                <i class="fas fa-user"></i>
                                <a href="/admin/unblock" class="underline text-gray-900 dark:text-white">Unblock</a>
                                <i class="fas fa-info-circle"></i>
                                <a href="/admin/statistics"
                                    class="underline text-gray-900 dark:text-white">Statistics</a>
                                <i class="far fa-address-book"></i>
                                <a href="/admin/logincnt" class="underline text-gray-900 dark:text-white">Login
                                    count</a>
                                <i class="far fa-comment-dots"></i>
                                <a href="/admin/sentmesg" class="underline text-gray-900 dark:text-white">Messages</a>
                            </div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-red text-lg">
                                • Vartotojas3
                                <i class="fas fa-user"></i>
                                <a href="/admin/unblock" class="underline text-gray-900 dark:text-white">Unblock</a>
                                <i class="fas fa-info-circle"></i>
                                <a href="/admin/statistics"
                                    class="underline text-gray-900 dark:text-white">Statistics</a>
                                <i class="far fa-address-book"></i>
                                <a href="/admin/logincnt" class="underline text-gray-900 dark:text-white">Login
                                    count</a>
                                <i class="far fa-comment-dots"></i>
                                <a href="/admin/sentmesg" class="underline text-gray-900 dark:text-white">Messages</a>
                            </div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 dark:text-gray-400 text-lg">
                                • Vartotojas4
                                <i class="fas fa-user-slash"></i>
                                <a href="/admin/block" class="underline text-gray-900 dark:text-white">Block</a>
                                <i class="fas fa-user"></i>
                                <a href="/admin/unblock" class="underline text-gray-900 dark:text-white">Unblock</a>
                                <i class="fas fa-info-circle"></i>
                                <a href="/admin/statistics"
                                    class="underline text-gray-900 dark:text-white">Statistics</a>
                                <i class="far fa-address-book"></i>
                                <a href="/admin/logincnt" class="underline text-gray-900 dark:text-white">Login
                                    count</a>
                                <i class="far fa-comment-dots"></i>
                                <a href="/admin/sentmesg" class="underline text-gray-900 dark:text-white">Messages</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lgg text-gray-200 leading-7 font-semibold">
                                Admin forumas
                            </div>

                        </div>
                        <div class="ml-12">
                            <div class="mt-2 dark:text-gray-400  text-lg">
                                <i class="fas fa-align-center"></i>
                                <a href="/admin/admin_forum" class="underline text-gray-900 dark:text-white">Forumas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@endif

</html>
