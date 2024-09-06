@extends('layouts/contentNavbarLayout')

@section('title', __('words.add-hall-pg'))

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">{{__('words.halls')}} /</span> {{__('words.add-hall')}}
</h4>

<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">{{__('words.hall-details')}}</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form action="/{{$lang}}/admin/add-hall" method="POST">
        @csrf
          <div class="row">
            <div class="mb-1 col-lg-12 col-md-6">              
              <label for="firstName" class="form-label">{{__('words.rename')}}</label>
              <div class="input-group">
              <input class="form-control" type="text" id="firstName" name="tm_name" placeholder="{{__('words.write-name')}}" autofocus />
              <span class="input-group-btn">
              <button class="btn-icon currency-green ">
                <span>TM</span>
              </button>
            </div>
            <span class="text-danger">@error('tm_name'){{$message}}@enderror<span>
              </div>
              <div class="mb-1 col-lg-12 col-md-6">              
                <!-- <label for="firstName" class="form-label">Наименование</label> -->
                <div class="input-group">
                <input class="form-control" type="text" id="firstName" name="ru_name" placeholder="{{__('words.write-name')}}" autofocus />
                <span class="input-group-btn">
                <button class="btn-icon currency-blue ">
                  <span>RU</span>
                </button>
                </div>
                <span class="text-danger">@error('ru_name'){{$message}}@enderror<span>
              </div>
            <div class="mb-3  col-lg-12 col-md-6">              
              <!-- <label for="firstName" class="form-label">Наименование</label> -->
              <div class="input-group">
              <input class="form-control" type="text" id="firstName" name="eng_name" placeholder="{{__('words.write-name')}}" autofocus />
              <span class="input-group-btn">
              <button class="btn-icon currency-usa">
                <span>EN</span>
              </button>
              </div>
              <span class="text-danger">@error('eng_name'){{$message}}@enderror<span>
            </div>
            <div class="col-12">
            <label for="firstName" class="form-label">{{__('words.status')}}</label>
                  <select name="status" id="input-status" class="form-control">
                    <option value="1" selected="selected">{{__('words.turn-on')}}</option>
                    <option value="0">{{__('words.turn-off')}}</option>
                  </select>
                </div>
          <div class="mt-5">
            <button type="submit" class="btn btn-primary me-2">{{__('words.save')}}</button>
            <a href="/{{$lang}}/admin/halls">
              <button type="button" class="btn btn-outline-secondary">{{__('words.cancel')}}</button>
            </a>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>  
  </div>
</div>
</div>

<!-- <div class="col-lg-11 my-3">
  <div class="card align-bottom ">
  <h5 class="card-header">Сохранено</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning bg-successfull">
            <h6 class="alert-heading fw-bold mb-1">Добавлено успешно</h6>
            <p class="mb-0">Зал успешно добавлен, перейдите во все залы для просмотра</p>
          </div>
        </div>
      </div>
    </div>
  </div> -->
@endsection
