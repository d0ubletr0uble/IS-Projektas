<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Žinučių langas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <link rel="stylesheet" href="css/messages.css">
    <script src="js/messages.js"></script>
    <script>
        $(document).ready(function () {
            $('#action_menu_btn1').click(function () {
                $('#action_menu1').toggle();
            });
            $('#action_menu_btn2').click(function () {
                $('#action_menu2').toggle();
            });
        });
    </script>
</head>
<!--Coded With Love By Mutiullah Samim-->
<body>
<br>
<div class="container-fluid h-100">

    <h1><a class="fas fa-home" href="/"></a> Žinučių langas</h1>
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            <p style="color:whitesmoke">
                                <a class="test2" href="/messages/groups/create"
                                   class="underline text-gray-900 dark:text-white">Naujos grupės sukūrimas</a>
                            </p>
                        </div>
                    </div>

                    <div class="input-group">
                        <input type="text" placeholder="Search..." name="" class="form-control search">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body">
                    <ui class="contacts">
                        @foreach($groups as $group)
                            @foreach($membmatymas as $membmatyma)
                                @if($membmatyma->matymas == 0 && $membmatyma->group_id == $group->id)
                                    <li id="{{$group->id}}" class="group_id"
                                        data-my_id="{{$group->getMemberId(Auth::id())}}">
                                        <div class="d-flex bd-highlight group">
                                            <div class="img_cont">
                                                <img
                                                    src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg"
                                                    class="rounded-circle user_img">
                                                <span class="online_icon offline"></span>
                                            </div>
                                            <div class="user_info">
                                                <span>{{$group->name}}</span>
                                                <br>
                                                @if($group->users_id == Auth::id())
                                                    <a class="text-warning" href="/messages/groups/{{$group->id}}/edit">Redaguoti</a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        @endforeach
                    </ui>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                 class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span id="group_name">Jonas</span>
                            <p>Žinučių istorija</p>
                        </div>
                    </div>
                </div>
                <div id="messages" class="card-body msg_card_body">
                    Palaukite, žinučių istorija tuojau atsiras
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <li id="action_menu_btn1" class="input-group-text attach_btn"><i
                                    class="fas fa-comments"></i></li>
                            <div id="action_menu1" class="action_menu">
                                <ul>
                                    <li><i class="fas"></i>Žinutės tipo meniu</li>
                                    <li><i class="fas fa-image"></i>Įkelti paveikslėlį
                                        <form action="/messages/photo" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" id="myFile" name="filename">
                                            <input type="hidden" name="group_id" value="">
                                            <input type="submit" value="Įkelti">
                                        </form>
                                    </li>
                                    <li><a id="audio" href="/messages/audio/create"><i class="fas fa-volume-up"></i>Įrašyti
                                            audio</a></li>
                                </ul>
                            </div>
                        </div>
                        <textarea id="input" class="form-control type_msg"
                                  placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <li id="action_menu_btn2" class="input-group-text btn"><i class="fas fa-smile-wink"></i>
                            </li>
                            <div id="action_menu2" class="action_menu">
                                <div class="grid-container">
                                    @foreach($emojis as $emoji)
                                        <div class="grid-item">
                                            <a class="delete" href="{{$emoji->id}}">X</a>
                                            <a class="emoji" href="{{$emoji->name}}"><img
                                                    src="{{asset('storage/emoji/'.$emoji->link)}}" width="50px"></a>
                                        </div>
                                    @endforeach
                                    <div class="grid-item">
                                        <a href="/messages/emoji/create" class="btn btn-primary">+</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <span class="input-group-text send_btn"><i id="send" class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

