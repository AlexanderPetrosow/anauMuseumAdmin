@extends('layouts/contentGuide')

@section('title', $exposure[0][$lang.'_name'])

@section('page-style')
<!-- My style -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/guide/style.css') }}">
@endsection

@section('content')
<a href="/{{$lang}}/home">
    <div class="btn-back">
    <i class="bx bx-arrow-back"></i>
    </div>
</a>
<!-- Collection title -->
<h1 class="cont-title">{{$exposure[0][$lang.'_name']}}</h1>
<!-- Collection image -->
@if(isset($exposure[0]['image']))
<img src="{{asset('storage/'.$exposure[0]['image'])}}" class="cl-img" alt="Collection" onContextMenu="return false;">
@endif
<!-- Collection audio -->
@if(isset($exposure[0][$lang.'_audio']))
<audio controls controlsList="nodownload">
    <source src="{{asset('storage/'.$exposure[0][$lang.'_audio'])}}" type="audio/mpeg">
</audio>
@endif
<!-- Collection description -->
@if($exposure[0][$lang.'_description'] != '')
    <div class="cl-text unselectable">
        <p>
            {{$exposure[0][$lang.'_description']}}
        </p>
    </div>
@endif
<!-- Collection objects (grid) -->

<div class="cl-grid" data-masonry="{'percentPosition': true }">
    @for($i = 0; $i < count($exhibit); $i++)
    <a href="/{{$lang}}/content/{{$exposure[0]['id']}}/{{$exhibit[$i]['id']}}">
        <div class="cl-one-obj">
            @if(isset($exhibit[$i]['image']))
            <img src="{{asset('storage/'.$exhibit[$i]['image'])}}" alt="Object">
            @else
            <img src="{{asset('assets/img/errors/placeholder.png')}}" alt="Object">
            @endif
            <div class="cl-obj-ttl">{{$exhibit[$i][$lang.'_name']}}</div>
            <div class="cl-obj-num">{{$i+1}}</div>
        </div>
    </a>
    @endfor
    <!-- for mass :) -->
    <!-- <div class="cl-one-obj">
        <img src="/assets/vendor/img/col2.png" alt="Object">
        <div class="cl-obj-ttl">Lorem ipsum dolor sit amet</div>
        <div class="cl-obj-num">2</div>
    </div>
    <div class="cl-one-obj">
        <img src="/assets/vendor/img/col3.png" alt="Object">
        <div class="cl-obj-ttl">Lorem ipsum dolor sit amet</div>
        <div class="cl-obj-num">3</div>
    </div>
    <div class="cl-one-obj">
        <img src="/assets/vendor/img/col4.png" alt="Object">
        <div class="cl-obj-ttl">Lorem ipsum dolor sit amet</div>
        <div class="cl-obj-num">4</div>
    </div> -->
</div>
@endsection