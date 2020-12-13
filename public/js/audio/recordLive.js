var audio_context,
    recorder,
    volume,
    volumeLevel = 0,
    currentEditedSoundIndex;

function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    console.log('Media stream created.');

    volume = audio_context.createGain();
    volume.gain.value = volumeLevel;
    input.connect(volume);
    volume.connect(audio_context.destination);
    console.log('Input connected to audio context destination.');

    recorder = new Recorder(input);
    console.log('Recorder initialised.');
}

function changeVolume(value) {
    if (!volume) return;
    volumeLevel = value;
    volume.gain.value = value;
}

function startRecording(button) {
    recorder && recorder.record();
    $("#stop").show();
    console.log('Recording...');
    button.remove();
}

function stopRecording(button) {
    recorder && recorder.stop();
    button.disabled = true;
    button.previousElementSibling.disabled = false;
    console.log('Stopped recording.');

    // create WAV download link using audio data blob
    createDownloadLink();

    recorder.clear();
}

function createDownloadLink() {
    currentEditedSoundIndex = -1;
    recorder && recorder.exportWAV(handleWAV.bind(this));
}

function handleWAV(blob) {
    let tableRef = document.getElementById('recordingslist');
    if (currentEditedSoundIndex !== -1) {
        $('#recordingslist tr:nth-child(' + (currentEditedSoundIndex + 1) + ')').remove();
    }

    // let url = URL.createObjectURL(blob);
    let group_id = $('#group_id').attr('content');
    let formData = new FormData();
    formData.append('audio', blob);
    formData.append('group_id', group_id);
    fetch('/messages/audio',
        {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content }
        }).then(r => location.href='/messages');
}

window.onload = function init() {
    try {
        // webkit shim
        window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        window.URL = window.URL || window.webkitURL || window.mozURL;

        audio_context = new AudioContext();
        console.log('Audio context set up.');
        console.log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
        console.warn('No web audio support in this browser!');
    }

    navigator.getUserMedia({audio: true}, startUserMedia, function (e) {
        console.warn('No live audio input: ' + e);
    });
};
