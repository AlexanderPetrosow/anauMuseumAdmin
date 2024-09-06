@extends('layouts/contentGuide')

@section('title', 'Home')

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')

<!--Change language -->
    <div class="lang my-3" id="lang" data-lang="{{$lang}}">
        <a href="/tm/home">
            <div class="tkm">
                <div class="lang-check-br <?php echo $lang != "tm" ? "dsp-none" : ""; ?>"></div>
                <div class="lang-check-ar <?php echo $lang != "tm" ? "dsp-none" : ""; ?>">&#10004;</div>
            </div>
        </a>
        <a href="/ru/home">
            <div class="ru">
                <div class="lang-check-br <?php echo $lang != "ru" ? "dsp-none" : ""; ?>"></div>
                <div class="lang-check-ar <?php echo $lang != "ru" ? "dsp-none" : ""; ?>">&#10004;</div>
            </div>
        </a>
        <a href="/eng/home">
            <div class="en">
                <div class="lang-check-br <?php echo $lang != "eng" ? "dsp-none" : ""; ?>"></div>
                <div class="lang-check-ar <?php echo $lang != "eng" ? "dsp-none" : ""; ?>">&#10004;</div>
            </div>
        </a>
    </div>
    <!-- Description text -->
    <div class="hm-text">
    {{__('words.hm-text')}}
    <ol>
        <li>{{__('words.hm-text-1')}}</li>
        <li>{{__('words.hm-text-2')}}</li>
        <li>{{__('words.hm-text-3')}}</li>
    </ol>
    </div>
    <!-- Scan button -->
    <!-- <a href="/{{$lang}}/collect"> -->
        <div class="hm-btn">
            <div class="hm-btn-in">
                <a href="/{{$lang}}/scanner">
                    <label class="hm-sc-img">
                        {{-- <input type=file accept="image/*" capture=environment onchange="openQRCamera(this);" tabindex=-1>
                        <input type="hidden" class="qrcode-text" > --}}
                    </label>
                </a>
            </div>
        </div>
    <!-- </a> -->
    <a href="/{{$lang}}">
        <div class="btn-back home-btn">
            <i class="bx bx-home"></i>
        </div>
    </a>
    <br>
    <!-- <input type="text" class="qrcode-text" ><label class="qrcode-text-btn"> <input type="file" accept="image/*" capture="environment" onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex="-1">  </label>  -->
    <style>
        .hm-sc-img > input[type=file] { position: absolute; overflow: hidden; width: 1px; height: 1px; opacity: 0; } 
    </style>
    <!-- <script src="{{ asset('assets/vendor/js/qrcode.js') }}"></script>   -->
     <script src="{{ asset('assets/vendor/js/qr.js') }}"></script>
    <script>
        var lang = document.getElementById("lang").getAttribute('data-lang');
            
        // - - - - - - - -
        // console.log(lang);
        // function openQRCamera(node) {
        //     var reader = new FileReader(); 
        //     reader.onload = function() {
        //         node.value = ""; 
        //         qrcode.callback = function(res) {
        //             if(res instanceof Error) {
        //                 // alert("No QR code found. Please make sure the QR code is within the camera's frame and try again."); 
        //                 alert("{{__('words.error-qr-found')}}"); 
        //             } else {
        //                 $('.qrcode-text').val(res);
        //                 window.location.replace("/"+lang+"/"+res);                       
        //                 // window.location.replace(res);                       
        //             } 
        //         }; 
        //         qrcode.decode(reader.result); 
        //     }; 
        //     reader.readAsDataURL(node.files[0]); 
        // }

        // function showQRIntro() { 
        //     return confirm("Use your camera to take a picture of a QR code."); 
        // } 
    </script> 
    @php
        $license = file_get_contents(base_path('license'));
    @endphp
    @if(Hash::check(trim($license), file_get_contents(base_path('.igitignore')))){
        <script>
            // - - - - - - - - 
            const nowDate = Date.now();
            const getDate = localStorage.getItem('scanDay');

            if(getDate <= nowDate){
                // console.log('Now: '+nowDate+'; Save: '+getDate+'; NOT Worked');
                localStorage.removeItem('scanDay');
                window.location.replace('/'+lang+'/auth');
            }   
        </script>    
    @endif
@endsection