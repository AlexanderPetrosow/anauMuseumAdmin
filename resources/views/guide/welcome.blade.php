@extends('layouts/contentGuide')

@section('title', 'Welcome')

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')
<!-- Museum image -->
<div class="wel-img"></div>
<!-- Chanche language -->
<div class="lang">
    <a href="/tm">
        <div class="tkm">
            <div class="lang-check-br <?php echo $lang != "tm" ? "dsp-none" : ""; ?>"></div>
            <div class="lang-check-ar <?php echo $lang != "tm" ? "dsp-none" : ""; ?>">&#10004;</div>
        </div>
    </a>
    <a href="/ru">
        <div class="ru">
            <div class="lang-check-br <?php echo $lang != "ru" ? "dsp-none" : ""; ?>"></div>
            <div class="lang-check-ar <?php echo $lang != "ru" ? "dsp-none" : ""; ?>">&#10004;</div>
        </div>
    </a>
    <a href="/eng">
        <div class="en">
            <div class="lang-check-br <?php echo $lang != "eng" ? "dsp-none" : ""; ?>"></div>
            <div class="lang-check-ar <?php echo $lang != "eng" ? "dsp-none" : ""; ?>">&#10004;</div>
        </div>
    </a>
</div>
<!-- Welcome text -->
<div class="wel-text">
    <h1>{{__('words.welcome-title')}}</h1>
    <p>{{__('words.welcome-text')}}</p>
</div>
<!-- Start button -->
<a href="/{{$lang}}/home">
    <div class="wel-btn">
        <div class="wel-btn-in">
        {{__('words.welcome-btn')}}
        </div>
    </div>
</a>
@endsection