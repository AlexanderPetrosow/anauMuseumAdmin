@extends('layouts/blankLayout')

@section('title', 'Авторизация - Музей')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="/{{$lang}}/auth" class="app-brand-link gap-2">
              <!-- <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])</span> -->
              <img src="{{asset('/assets/vendor/img/emblem.png')}}" width="100">
              <!-- <span class="app-brand-text demo text-body fw-bolder">{{config('variables.templateName')}}</span> -->
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">{{__('words.welcome')}} {{config('variables.templateName')}}!</h4>
          <p class="mb-4">{{__('words.please-login')}}</p>
          <p class="mb-4 text-danger">@error('auth'){{$message}}@enderror</p>
          <!-- @if($errors->any())
          @foreach($errors->all() as $err)
          <p class="mb-4">{{$err}}</p>
          @endforeach
          @endif -->
          <p class="text-danger">@error('goodbye'){{$message}}@enderror</p>
          <form action="/{{$lang}}/admin/auth" class="mb-3" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">{{__('words.login')}}</label>
              <input type="text" class="form-control" id="email" name="login" placeholder="{{__('words.enter-login')}}" autofocus>
              <span class="text-danger">@error('login'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">{{__('words.password')}}</label>
                <!-- <a href="{{url('auth/forgot-password-basic')}}">
                  <small>Forgot Password?</small>
                </a> -->
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              <span class="text-danger">@error('password'){{$message}}@enderror<span>
            </div>
            
            <!-- <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                Запомнить меня
                </label>
              </div>
            </div> -->
            <div class="mb-3 col-md-12">
              <!-- <label class="form-label" for="language">Язык</label> -->
              <select id="country" name="langs" class="select2 form-select">
                <option value="ru" @if($lang == "ru") selected @endif>{{__('words.russian')}}</option>
                <option value="tm" @if($lang == "tm") selected @endif>{{__('words.turkmen')}}</option>               
              </select>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">{{__('words.auth-login')}}</button>
            </div>
            
          </form>

          <!-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p> -->
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>
@endsection
