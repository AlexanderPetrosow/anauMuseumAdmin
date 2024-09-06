@extends('layouts/contentGuide')

@section('title', 'Scanner')

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')

<style>
    html, body{
        overflow: hidden;
        width: 100vw;
        height: 95vh;
    }
    #video-container {
        line-height: 0;
    }
    #qr-video{
        width: 100vw;
        height: 95vh;
        object-fit: cover;
    }

    #video-container.example-style-1 .scan-region-highlight-svg,
    #video-container.example-style-1 .code-outline-highlight {
        stroke: #64a2f3 !important;
    }
    .loader {
      width: 84px;
      height: 84px;
      position: relative;
    }
    .loader:before , .loader:after {
      content: "";
      position: absolute;
      left: 50%;
      bottom: 0;
      width:64px;
      height: 64px;
      border-radius: 50%;
      background:#64a2f3;
      transform: translate(-50% , -100%)  scale(0);
      animation: push 2s infinite linear;
    }
    .loader:after {
      animation-delay: 1s;
    }
    @keyframes push {
        0% , 50%{ transform: translate(-50% , 0%)  scale(1) }
      100% { transform: translate(-50%, -100%) scale(0) }
    }
</style>
<div id="lang" data-lang="{{$lang}}"></div>
{{-- <div class="h-100 camera_access d-flex flex-column justify-content-center align-items-center text-center">
    <i class="bx bx-camera display-1"></i>
    <h4>Разрешите доступ к камере<br>для работы сканнера</h4>
</div> --}}
<div class="loading h-100 d-none justify-content-center align-items-center">
    <span class="loader"></span>
</div>
<div id="video-container" class="example-style-1">
    <video id="qr-video"></video>
</div>
<span id="cam-qr-result" class="d-none"></span>
<script type="module">
    var lang = document.getElementById("lang").getAttribute('data-lang');
    import QrScanner from "{{asset('assets/js/qr-scanner.min.js')}}";

    const video = document.getElementById('qr-video');
    const videoContainer = document.getElementById('video-container');
    const camQrResult = document.getElementById('cam-qr-result');

    function setResult(label, result) {
        // alert(result.data);
        window.location.replace("/"+lang+"/"+result.data);
        $('.loading').removeClass('d-none').addClass('d-flex');
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
        scanner.stop();
    }

    // ####### Web Cam Scanning #######
    const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
        onDecodeError: error => {
            // camQrResult.textContent = error;
            // camQrResult.style.color = 'inherit';
        },
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });


    scanner.start().then(() => {
        // $('.camera_access').remove();
        QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
            const option = document.createElement('option');
            option.value = camera.id;
            option.text = camera.label;
            camList.add(option);
        }));
    });

    QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);
    window.scanner = scanner;

</script>
@endsection