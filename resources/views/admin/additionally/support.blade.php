@extends('layouts/contentNavbarLayout')

@section('title', __('words.support-pg'))

@section('content')
<div class="row card p-4" style="flex-direction: row!important ">
  <div class="col-lg-6 ">
    <h3>{{__('words.contact-info')}}:</h3>
    <h4>
      Email:
    </h4>
    <a href="mailto:info@arassanusga.com">info@arassanusga.com</a>
    <h4 class="mt-3">
      {{__('words.phone')}}:
    </h4>
    <a href="tel:+99312754799">+993 12 754799</a><br />
    <a href="tel:+99361648605">+993 61 648605</a>

    <h4 class="mt-3">
    {{__('words.address')}}:
    </h4>
    <div>
    {{__('words.arassa-nusga-adress')}}</div>
  </div>
  <div class="col-lg-6" style="text-align:end">
    <img class="card-img-top" src="/assets/img/icons/brands/arassanusga-logo.png" style="width:50% !important">
  </div>
</div>
    @endsection


    