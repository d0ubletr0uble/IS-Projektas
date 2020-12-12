<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HTML5 Audio Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta id="group_id" content="{{ $group->id }}">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>
</head>

<body>
<br>
<br>
<div class="recorder container d-flex justify-content-center rounded" style="background: #cedce7">
    <div class="d-flex flex-column">
        <br>
        <h2>Audio įrašymo langas</h2><br>
        <i class="fas fa-microphone fa-7x d-flex justify-content-center"></i><br>
        <button id="start" class="btn btn-primary" onclick="startRecording(this);">Pradėti įrašymą</button>
        <button id="stop" class="btn btn-warning" onclick="stopRecording(this);" style="display: none">Baigti įrašymą</button>
        <br>
    </div>
</div>

<script src="/js/audio/lib/recorder.js"></script>
<script src="/js/audio/recordLive.js"></script>

</body>
</html>
