@extends('layouts/contentNavbarLayout')

@section('title',__('words.ticket-list-pg'))

@section('content')
<!-- <h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Билеты / </span> Connections
</h4> -->
<div id="errors"></div>
<form method="POST" action="/{{$lang}}/admin/delete-ticket/{{count($tickets)}}">
  @csrf
  <div class="demo-inline-spacing d-flex justify-content-between">
    <a href="/{{$lang}}/admin/add-ticket">
      <div class="btn btn-primary me-2 mb-4" tabindex="0">{{__('words.new-ticket')}}
      </div>
    </a>
    <div>
      {{-- <button type="<?php echo session('group') == 2 ? 'button' : 'submit' ; ?>" class="<?php echo session('group') == 2 ? "err-btn" : ""; ?> btn btn-icon <?php echo session('group') == 1 ? "btn-primary" : "btn-secondary"; ?>">
        <img src="/assets/img/icons/unicons/dustbin.png" height="25;">
      </button> --}}
    </div>
  </div>
</form>

<div class="row justify-content-between">
  <div class="col-lg-8 card">
    <table class="table">
      <thead>
        <tr>
          {{-- <th scope="col"> --}}
            <!-- <input class="form-check-input me-1" type="checkbox" value=""> -->
          {{-- </th> --}}
          <th scope="col">{{__('words.order-num')}}</th>
          <th scope="col">{{__('words.ticket-num')}}</th>
          <th scope="col">{{__('words.tariffs')}}</th>
          <th scope="col">{{__('words.price')}}</th>
          <th scope="col">{{__('words.date')}}</th>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($tickets as $ticket)
        <tr class="@if(count($tickets) <= ($i+1)) border-transparent @endif">
          {{-- <th><input class="form-check-input me-1" type="checkbox" name="check{{$i}}" value="{{$ticket['id']}}"></th> --}}
          <th scope="row">{{$ticket['order_id']}}</th>
          <td>{{$ticket['id']}}</td>
          @foreach($tariffs as $tariff)
            @if($ticket['tariff_id'] == $tariff['id'])
              <td>{{$tariff[$lang.'_name']}}</td>
              @endif
          @endforeach
          @foreach($currencies as $currency)
            @if($ticket['currency_id'] == $currency['id'])
              <td>{{$ticket['price']}} {{$currency['name']}}</td>
            @endif
          @endforeach
          <td>{{$ticket['created_at']}}</td>
        </tr>
        <tr>
        @php
        $i++;
        @endphp
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Filter -->
  <div class="col-lg-4">
    <div class="card py-3 px-3">
      <form method="POST" action="/{{$lang}}/admin/tickets">
      @csrf
        <div class="mb-12 pl-3 col-md-12">
          <div class="filter">
            <div class="col-4 d-flex justify-content-around py-2"><img src="{{asset('assets/img/icons/unicons/filter-filled-too.png')}}" width="15">{{__('words.filter')}}</div>
          </div>
          <label for="firstName" class="form-label mt-3">{{__('words.order-num')}}</label>
          <input class="form-control" type="text" id="orderNum" name="orderId" placeholder="1234" autofocus value="@if(isset($_POST['orderId'])) {{$orderId}} @endif" />
        </div>

        <div class="mb-12 col-md-12">
          <label for="firstName" class="form-label mt-3">{{__('words.order-date')}}</label>
          <input class="form-control" type="date" id="orderDate" name="dates" value="@if(isset($_POST['dates'])){{$dates}}@endif" autofocus />
        </div>
        <div class="mt-2">
          <button type="submit" class="btn btn-primary me-2 mt-3">{{__('words.search')}}</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Filter end -->

  <!-- <div class="col-lg-12 card mt-3">
    <div class="card align-bottom">
      <h5 class="card-header">{{__('words.delete-ticket')}}</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Вы уверены, что хотите удалить билет?</h6>
            <p class="mb-0">Как только вы удалите заказ, пути назад уже не будет. Пожалуйста, будьте уверены.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">Я подтверждаю удаление билета</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Удалить билет</button>
        </form>
      </div>
    </div>
  </div> -->
  @if(!isset($req->orderId) || !isset($req->dates))
    <div class="d-flex justify-content-center mt-3">
      {{$tickets->links()}}
    </div>
  @endif
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