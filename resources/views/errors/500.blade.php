@extends('layouts/contentGuide')

@section('title', 'Home')

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')

<div class="container mt-5 text-center">
    <img src="{{asset('assets/img/errors/500.png')}}" class="w-50 mb-3">
    <a href="/tm/admin">
        <div class="btn-back m-auto">
            <i class="bx bx-home"></i>
        </div>
    </a>
</div>

@endsection