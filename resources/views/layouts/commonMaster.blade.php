<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title')</title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <!-- Include Styles -->
  @include('layouts/sections/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
</head>

<body>
  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->

  @if(!Hash::check(trim(file_get_contents(base_path('license'))), file_get_contents(base_path('.igitignore'))))
  <div class="buy-now">
    <button class="btn btn-primary btn-buy-now" data-bs-toggle="modal" data-bs-target="#licenseCode">{{__('words.activ_btn')}}</button>
  </div>
  @endif
  {{-- Modal --}}
  <div class="modal fade" id="licenseCode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="licenseCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="licenseCodeLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-center">
            <img src="/assets/img/icons/brands/arassanusga-logo.png" alt="Arassa Nusga">
          </p>
          <p class="text-muted">{{__('words.activ_description')}}</p>
          <form action="/{{$lang}}/admin/license" method="post">
            @csrf
            <div class="row">
              <div class="col-8">
                <input type="text" class="form-control" name="code" placeholder="{{__('words.activ_placeholder')}}">
              </div>
              <div class="col-4">
                <input type="submit" class="btn btn-primary w-100" value="{{__('words.activ_btn')}}">
              </div>
            </div>
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
  </div>

  <!-- Include Scripts -->
  @include('layouts/sections/scripts')

</body>

</html>
