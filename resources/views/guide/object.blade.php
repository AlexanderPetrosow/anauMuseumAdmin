@extends('layouts/contentGuide')

@section('title', $exhibit[0][$lang.'_name'])

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')
@if($exposureId == 0)
<a href="/{{$lang}}/home">
@else
<a href="/{{$lang}}/content/{{$exposureId}}/0">
@endif
    <div class="btn-back">
    <i class="bx bx-arrow-back"></i>
    </div>
</a>

<!-- Object title -->
<div class="cont-title">
<h1>{{$exhibit[0][$lang.'_name']}}</h1>
</div>
<!-- Object image -->
@if(isset($exhibit[0]['image']))
<img src="{{asset('storage/'.$exhibit[0]['image'])}}" class="obj-img" alt="Object" onContextMenu="return false;">
@endif
<!-- Object audio -->
@if(isset($exhibit[0][$lang.'_audio']))
<audio controls controlsList="nodownload">
    <source src="{{asset('storage/'.$exhibit[0][$lang.'_audio'])}}" type="audio/mpeg">
</audio>
@endif
<!-- Object description -->
<div class="ob-text">
    <p>
        {{$exhibit[0][$lang.'_description']}}
    </p>
</div>
<div class="mt-4 mb-6 d-flex justify-content-center">
    <img src="{{asset('assets/img/icons/unicons/line.png')}}" alt="" class="w-50">
</div>
@endsection