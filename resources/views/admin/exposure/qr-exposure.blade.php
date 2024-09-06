@extends('layouts/contentNavbarLayout')

@section('title', __('words.generate-exposure-pg'))

@section('content')

<?php
    // ----------- QR CODE GENERATOR ----------
    
    include('../phpqrcode/qrlib.php');
    QRcode::png('content/'.$exposureId.'/0', '../public/assets/img/qr/exposure-'.$exposureId.'.png', 'H', 8, 2);

    // -- END ----------------------- QR CODE -
?>

<div class="container h-100 d-flex justify-content-center align-items-center">
<div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
      <h5 class="card-title">{{ $exposure[0][$lang.'_name'] }}</h5>
      @if(strlen($exposure[0][$lang.'_description']) > 90)
      <span class="card-text">{{mb_substr($exposure[0][$lang.'_description'],0,90).'...'}}</span>
      @else
      <span class="card-text">{{ $exposure[0][$lang.'_description'] }}</span>
      @endif 
      <img class="card-img-top my-2" src="{{ asset('assets/img/qr/exposure-'.$exposureId.'.png') }}">
        <button class="btn btn-primary">Распечатать</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
      $('.btn').click(function(){
        $('.layout-wrapper').remove();
        $('.buy-now').remove();
        $("body").append("<img src=\"{{ asset('assets/img/qr/exposure-'.$exposureId.'.png') }}\">");
        window.print();  
      });
    });
    var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
        if (!mql.matches) {
            window.location.replace("/{{$lang}}/admin/exposures");
        }
    });
</script>

@endsection