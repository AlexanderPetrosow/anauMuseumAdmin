@extends('layouts/contentNavbarLayout')

@section('title',__('words.tariff-list-pg'))

@section('content')
<!-- <h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Билеты / </span> Connections
</h4> -->

<div id="errors"></div>
@if($errors->any())
<div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
  <span>@error('deleted'){{$message}}@enderror</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form method="POST" action="/{{$lang}}/admin/delete-tariff/{{count($tariffs)}}">
  @csrf
<div class="demo-inline-spacing d-flex justify-content-end">
  <a href="/{{$lang}}/admin/add-tariff">
    <button type="button" class="btn btn-icon btn-primary">
    <span class="fs-1 text-white">+</span>
    </button>
  </a>
  <!-- <a href=""> -->
    {{-- <button type="<?php echo session('group') == 2 ? 'button' : 'submit' ; ?>" class="<?php echo session('group') == 2 ? "err-btn" : ""; ?> btn btn-icon <?php echo session('group') == 1 ? "btn-primary" : "btn-secondary"; ?>">
    <img src="/assets/img/icons/unicons/dustbin.png" height=25;>
    </button> --}}
  <!-- </a> -->
</div>


<div class="row">
  <div class="col-lg-12 card mt-3 py-3">

    <table class="table">
      <thead>
        <tr>
          {{-- <th scope="col"> --}}
            <!-- <input class="form-check-input me-1" type="checkbox" value=""> -->
          {{-- </th> --}}
          <th scope="col">{{__('words.rename')}}</th>
          <th scope="col">{{__('words.comments')}}</th>
          <th scope="col">{{__('words.sorting')}}</th>
          <th scope="col">{{__('words.status')}}</th>
          <th scope="col">{{__('words.changing-date')}}</th>
          <th scope="col">{{__('words.adding-date')}}</th>
          <th scope="col">{{__('words.action')}}</th>
        </tr>
      </thead>
      <tbody>
      @php
      $i = 0;
      @endphp
      @foreach($tariffs as $tariff)
        <tr class="@if(count($tariffs) <= ($i+1)) border-transparent @endif">
          {{-- <th><input class="form-check-input me-1" type="checkbox"  name="check{{$i}}" value="{{$tariff['id']}}"></th> --}}
          <td>{{ $tariff[$lang.'_name'] }}</td>
          <td>{{ $tariff['comment'] }}</td>
          <td>{{ $tariff['sort'] }}</td>
          @if($tariff['status'] == 1)
          <td>{{__('words.turn-on')}}</td>
          @else
          <td>{{__('words.turn-off')}}</td>
          @endif
          <td>{{ $tariff['updated_at'] }}</td>
          <td>{{ $tariff['created_at'] }}</td>
          <td>
            <a href="/{{$lang}}/admin/edit-tariff/{{$tariff['id']}}">
              <button type="button" class="btn btn-icon">
                <img src="/assets/img/icons/unicons/edit-tools.png" height=25;>
              </button>
            </a>
          </td>
        </tr>
      @php
      $i++;
      @endphp
      @endforeach
      </tbody>
    </table>
  </div>
<!-- <div class="col-lg-12 card mt-3 p-0">
  <div class="card align-bottom">
    <h5 class="card-header">Удалить тариф</h5>
    <div class="card-body">
      <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
          <h6 class="alert-heading fw-bold mb-1">Вы уверены, что хотите удалить тариф?</h6>
          <p class="mb-0">Как только вы удалите заказ, пути назад уже не будет. Пожалуйста, будьте уверены.</p>
        </div>
      </div>
      <form id="formAccountDeactivation" onsubmit="return false">
        <button type="submit" class="btn btn-danger deactivate-account">Удалить тариф</button>
      </form>
    </div>
  </div>
</div> -->
</form>

<div class="d-flex justify-content-center mt-3">
    {{$tariffs->links()}}
  </div>
</div>

<script>
  $(document).ready(function(){
    $('.err-btn').click(function(){
      $('#errors').html('<div class="col-12 alert alert-danger alert-dismissible fade show" role="alert"><span>Доступ заблокирован</span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    });

    $('input[type=checkbox]').change(function(){
      $('input[type=checkbox]').prop('checked', false);
      $(this).prop('checked', true); 
    });
  });
</script>
@endsection