@extends('layouts/contentGuide')

@section('title', 'Home')

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')

<div class="container mt-5">
    <img src="{{asset('assets/img/errors/404.png')}}" class="w-100">
    <a href="/tm">
        <div class="btn-back m-auto">
            <i class="bx bx-home"></i>
        </div>
    </a>
</div>

@endsection