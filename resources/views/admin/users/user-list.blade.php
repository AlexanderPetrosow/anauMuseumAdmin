@extends('layouts/contentNavbarLayout')

@section('title', __('words.user-list-pg'))

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

<form method="POST" action="/{{$lang}}/admin/delete-user/{{count($users)}}">
  @csrf
<div class="demo-inline-spacing d-flex justify-content-end">
  <a href="<?php echo session('group') == 1 ? "/$lang/admin/add-user" : "#"; ?>">
    <button type="button" class="<?php echo session('group') == 2 ? "err-btn" : ""; ?> btn btn-icon <?php echo session('group') == 1 ? "btn-primary" : "btn-secondary"; ?>">
      <span class="fs-1 text-white">+</span>
    </button>
  </a>
  {{-- <button type="<?php echo session('group') == 2 ? 'button' : 'submit' ; ?>" class="<?php echo session('group') == 2 ? "err-btn" : ""; ?> btn btn-icon <?php echo session('group') == 1 ? "btn-primary" : "btn-secondary"; ?>">
    <img src="/assets/img/icons/unicons/dustbin.png" height=25;>
  </button> --}}
</div>


<div class="row h-75">
  <div class="col-lg-12 card mt-3 py-3 h-75">

    <table class="table">
      <thead>
        <tr>
          {{-- <th scope="col-12"> --}}
            <!-- <input class="form-check-input me-1" type="checkbox" value=""> -->
          {{-- </th> --}}
          <th scope="col-2">{{__('words.fio')}}</th>
          <th scope="col-8">{{__('words.login')}}</th>
          <th scope="col-2">{{__('words.access')}}</th>
          <th scope="col-2">{{__('words.status')}}</th>
          <th scope="col-2">{{__('words.changing-date')}}</th>
          <th scope="col-2">{{__('words.adding-date')}}</th>
          <th scope="col-2" style="text-align: center;">{{__('words.action')}}</th>
        </tr>
      </thead>
      <tbody>
      @php
      $i = 0;
      @endphp
      @foreach($users as $user)
        <tr class="@if(count($users) <= ($i+1)) border-transparent @endif">
          {{-- <th><input class="form-check-input me-1" type="checkbox" name="check{{$i}}" value="{{$user['id']}}"></th> --}}
          <td>{{$user['name']}}</td>
          <td>{{$user['login']}}</td>
          <!-- Group -->
          @if($user['group'] == "1")
          <td>{{__('words.admin')}}</td>
          @elseif($user['group'] == "2")
          <td>{{__('words.casher')}}</td>
          @elseif($user['group'] == "3")
          <td>{{__('words.content')}}</td>
          @endif
          <!-- Status -->
          @if($user['status'] == "1")
          <td>{{__('words.turn-on')}}</td>
          @else
          <td>{{__('words.turn-off')}}</td>
          @endif
          <td>{{$user['updated_at']}}</td>
          <td>{{$user['created_at']}}</td>
          <td class="text-center">
            <a href="<?php echo session('group') == 1 ? "/$lang/admin/edit-user/".$user['id'] : "#"; ?>">
              <button type="button" class="<?php echo session('group') == 2 ? "err-btn" : ""; ?> btn btn-icon">
                <img src="/assets/img/icons/unicons/edit-tools<?php echo session('group') == 2 ? "-disable" : ""; ?>.png" height=25;>
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
    <h5 class="card-header">Удалить пользователя</h5>
    <div class="card-body">
      <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
          <h6 class="alert-heading fw-bold mb-1">Вы уверены, что хотите удалить пользователя?</h6>
          <p class="mb-0">Как только вы удалите пользователя, пути назад уже не будет. Пожалуйста, будьте уверены.</p>
        </div>
      </div>
      <form id="formAccountDeactivation" onsubmit="return false">
        <button type="submit" class="btn btn-danger deactivate-account">Удалить пользователя</button>
      </form>
    </div>
  </div>
</div> -->

  <div class="d-flex justify-content-center mt-3">
      {{$users->links()}}
  </div>
</div>
</form>

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