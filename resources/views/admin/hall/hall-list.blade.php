@extends('layouts/contentNavbarLayout')

@section('title', __('words.hall-list-pg'))

@section('content')

<div id="errors"></div>
@if($errors->any())
<div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
  <span>@error('deleted'){{$message}}@enderror</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form method="POST" action="/{{$lang}}/admin/delete-hall/{{count($halls)}}">
  @csrf
<div class="demo-inline-spacing d-flex justify-content-end">
  <a href="/{{$lang}}/admin/add-hall">  
  <button type="button" class="btn btn-icon btn-primary">
  <span class="fs-1 text-white">+</span>
  </a>
  {{-- </button>
  <button type="<?php echo session('group') == 2 ? 'button' : 'submit' ; ?>" class="<?php echo session('group') == 2 ? "err-btn" : ""; ?> btn btn-icon <?php echo session('group') == 1 ? "btn-primary" : "btn-secondary"; ?>">
  <img src="/assets/img/icons/unicons/dustbin.png" height=25;>
  </button> --}}

</div>


<div class="row">
  <div class="col-lg-12 card mt-3 py-3">

    <table class="table">
      <thead>
        <tr>
          {{-- <th scope="col-12"> --}}
            <!-- <input class="form-check-input me-1" type="checkbox" value=""> -->
          {{-- </th> --}}
          <th scope="col-8">{{__('words.rename')}}</th>
          <th scope="col-2">{{__('words.status')}}</th>
          <th scope="col-8">{{__('words.changing-date')}}</th>
          <th scope="col-8">{{__('words.adding-date')}}</th>
          <th scope="col-2" class="text-center">{{__('words.action')}}</th>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($halls as $hall)
        <tr class="@if(count($halls) <= ($i+1)) border-transparent @endif">
          {{-- <th><input class="form-check-input me-1" type="checkbox" name="check{{$i}}" value="{{$hall['id']}}"></th> --}}
          <td>{{$hall[$lang.'_name']}}</td>
          @if($hall['status'] == 1)
          <td>{{__('words.turn-on')}}</td>
          @else
          <td>{{__('words.turn-off')}}</td>
          @endif
          <td>{{$hall['updated_at']}}</td>
          <td>{{$hall['created_at']}}</td>
          <td class="text-center">
            <a href="/{{$lang}}/admin/edit-hall/{{$hall['id']}}">
              <button type="button" class="btn btn-icon">
                <img src="/assets/img/icons/unicons/edit-tools.png" height=25;>
              </button>
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
    <h5 class="card-header">Удалить зал</h5>
    <div class="card-body">
      <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
          <h6 class="alert-heading fw-bold mb-1">Вы уверены, что хотите удалить зал?</h6>
          <p class="mb-0">Как только вы удалите зал, пути назад уже не будет. Пожалуйста, будьте уверены.</p>
        </div>
      </div>
      <form id="formAccountDeactivation" onsubmit="return false">
        <button type="submit" class="btn btn-danger deactivate-account">Удалить зал</button>
      </form>
    </div>
  </div>
</div> -->
</form>

  <div class="d-flex justify-content-center mt-3">
    {{$halls->links()}}
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