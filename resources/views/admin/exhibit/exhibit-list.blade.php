@extends('layouts/contentNavbarLayout') @section('title',__('words.exhibit-list-pg'))
@section('content')
<!-- <h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Билеты / </span> Connections
</h4> -->

<div id="errors"></div>
<form method="POST" action="/{{$lang}}/admin/delete-exhibit/{{count($exhibits)}}">
@csrf
<div class="demo-inline-spacing d-flex justify-content-end">
  <a href="/{{$lang}}/admin/qr-all-exhibit">
    <button type="button" class="btn btn-primary">
      <span class="fs-6 text-white">
        {{__('words.all_print')}}
      </span>
    </button>
  </a>
  <a href="/{{$lang}}/admin/add-exhibit">
    <button type="button" class="btn btn-icon btn-primary">
      <span class="fs-1 text-white">+</span>
    </button>
  </a>
  {{-- <button type="<?php echo session('group') == 2 ? 'button' : 'submit'; ?>" class="<?php echo session('group') == 2 ? "err-btn" : ""; ?> btn btn-icon <?php echo session('group') == 1 ? "btn-primary" : "btn-secondary"; ?>">
    <img src="/assets/img/icons/unicons/dustbin.png" height="25;" />
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
          <!-- <th scope="col-8">{{__('words.comments')}}</th> -->
          <th scope="col-8">{{__('words.hall')}}</th>
          <th scope="col-8">{{__('words.exposures')}}</th>
          <!-- <th scope="col-2">{{__('words.sorting')}}</th> -->
          <th scope="col-2">{{__('words.status')}}</th>
          <th scope="col-8">{{__('words.changing-date')}}</th>
          <th scope="col-8">{{__('words.adding-date')}}</th>
          <th scope="col-2" class="text-center">{{__('words.action')}}</th>
          <th scope="col-2" class="text-center">QR code</th>
        </tr>
      </thead>
      <tbody>
      @for($i=0; $i < count($exhibits); $i++)
        <tr class="@if(count($exhibits) <= ($i+1)) border-transparent @endif">
          {{-- <th><input class="form-check-input me-1" type="checkbox" name="check{{$i}}" value="{{$exhibits[$i]['id']}}"></th> --}}
          <td>{{$exhibits[$i][$lang.'_name']}}</td>
          <!-- @if(strlen($exhibits[$i][$lang.'_description']) > 40)
          <td>{{mb_substr($exhibits[$i][$lang.'_description'],0,40).'...'}}</td>
          @else
          <td>{{$exhibits[$i][$lang.'_description']}}</td>
          @endif -->
          <td>{{$halls_name[$i]}}</td>
          <td>{{$exposures_name[$i]}}</td>
          <!-- <td>{{$exhibits[$i]['sort']}}</td> -->
          @if($exhibits[$i]['status'] == 1)
          <td>{{__('words.turn-on')}}</td>
          @else
          <td>{{__('words.turn-off')}}</td>
          @endif
          <td>{{$exhibits[$i]['updated_at']}}</td>
          <td>{{$exhibits[$i]['created_at']}}</td>
          <td class="text-center">
            <a href="/{{$lang}}/admin/edit-exhibit/{{$exhibits[$i]['id']}}">
              <button type="button" class="btn btn-icon">
                <img src="/assets/img/icons/unicons/edit-tools.png" height=25;>
              </button>
            </a>
          </td>
          <td class="text-center">
            <a href="/{{$lang}}/admin/qr-exhibit/{{$exhibits[$i]['exposure_id']}}/{{$exhibits[$i]['id']}}">
              <button type="button" class="btn btn-icon">
                <img src="/assets/img/icons/unicons/qr-code.png" height=25;>
              </button>
            </a>
          </td>
        </tr>
      @endfor
      </tbody>
    </table>
  </div>
  <!-- <div class="col-lg-12 card mt-3 p-0">
    <div class="card align-bottom">
      <h5 class="card-header">Удалить экспонат</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">
              Вы уверены, что хотите удалить экспонат?
            </h6>
            <p class="mb-0">
              Как только вы удалите экспонат, пути назад уже не будет.
              Пожалуйста, будьте уверены.
            </p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <button type="submit" class="btn btn-danger deactivate-account">
            Удалить экспонат
          </button>
        </form>
      </div>
    </div>
  </div> -->
  <div class="d-flex justify-content-center mt-3">
    {{$exhibits->links()}}
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
