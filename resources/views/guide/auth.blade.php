@extends('layouts/contentGuide')

@section('title', 'Auth')

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')

<div class="auth" id="lang" data-lang="{{$lang}}">
        <div class="auth-main">
            <form method="POST" action="/{{$lang}}/auth" id="auth">
            @csrf    
            <div class="lang">
                <a href="/tm/auth">
                    <div class="tkm">
                        <div class="lang-check-br <?php echo $lang != "tm" ? "dsp-none" : ""; ?>"></div>
                        <div class="lang-check-ar <?php echo $lang != "tm" ? "dsp-none" : ""; ?>">&#10004;</div>
                    </div>
                </a>
                <a href="/ru/auth">
                    <div class="ru">
                        <div class="lang-check-br <?php echo $lang != "ru" ? "dsp-none" : ""; ?>"></div>
                        <div class="lang-check-ar <?php echo $lang != "ru" ? "dsp-none" : ""; ?>">&#10004;</div>
                    </div>
                </a>
                <a href="/eng/auth">
                    <div class="en">
                        <div class="lang-check-br <?php echo $lang != "eng" ? "dsp-none" : ""; ?>"></div>
                        <div class="lang-check-ar <?php echo $lang != "eng" ? "dsp-none" : ""; ?>">&#10004;</div>
                    </div>
                </a>
            </div>
            <h2 style="margin-top: 10px">{{__('words.museum_name')}}</h2>
            <p class="mb-4 text-danger" id="error">@error('auth'){{$message}}@enderror</p>
            <div class="auth-block">
                <label for="login" class="auth-text">{{__('words.login')}}</label><br>
                @if(!isset($login))
                <input type="text" class="auth-inp" name="login" id="login">
                @else
                <input type="text" class="auth-inp" name="login" id="login" value="{{$login}}">
                @endif
                <span class="text-danger">@error('login'){{$message}}@enderror<span>
            </div>
            <div class="auth-block">
                <label for="password" class="auth-text">{{__('words.password')}}</label><br>
                @if(!isset($password))
                <input type="password" class="auth-inp" name="password" id="password">
                @else
                <input type="password" class="auth-inp" name="password" id="password" value="{{$password}}">
                @endif
                <span class="text-danger">@error('password'){{$message}}@enderror<span>
            </div>
            <button class="btn">
                <div class="btn-in">
                {{__('words.auth-login')}}
                </div>
            </button>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var lang = document.getElementById("lang").getAttribute('data-lang');

            const nowDate = Date.now();
            const getDate = localStorage.getItem('scanDay');
            if(getDate){
                if(value >= scanDate){
                    window.location.replace('/'+lang+'/home');
                }
            }
            
            var p = $('#password').val();
            if(p.length == 8){
                if($('#error').text() == ""){
                    // Minute = 60000
                    // Day = 86400000
                    localStorage.setItem('scanDay', nowDate + 86400000);
                    $("#auth").submit();
                }
            }
        });
    </script>
@endsection