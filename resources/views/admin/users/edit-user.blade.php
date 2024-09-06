@extends('layouts/contentNavbarLayout')

@section('title', __('words.edit-user-pg'))

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">{{__('words.users')}} /</span> {{__('words.edit-user')}}
</h4>

<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">{{__('words.user-details')}}</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form action="/{{$lang}}/admin/edit-user/{{$user[0]['id']}}" method="POST">
        @csrf
          <div class="row">
            <div class="mb-3 col-12">              
              <label for="firstName" class="form-label">{{__('words.login')}}</label>
              <div class="input-group">
              <input class="form-control" type="text" id="firstName" name="login" placeholder="admin-maral / kassir-maral / content-maral" value="{{$user[0]['login']}}" autofocus />
              <span class="input-group-btn">
              </div>
              <span class="text-danger">@error('login'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-12">              
              <label for="firstName" class="form-label">{{__('words.fio')}}</label>
              <div class="input-group">
              <input class="form-control" type="text" id="firstName" name="name" placeholder="Maral Myradova" value="{{$user[0]['name']}}" autofocus />
              <span class="input-group-btn">
              </div>
              <span class="text-danger">@error('name'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="basic-default-password32">{{__('words.new-password')}}</label>
                <div class="input-group input-group-merge">
                  <input type="password" class="form-control" name="password" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password">
                  <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
                </div>
                <span class="text-danger">@error('password'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-md-12">
              <label for="language" class="form-label">{{__('words.access')}}</label>
              <select id="language" name="group" class="select2 form-select">
                <option value="1" <?php echo $user[0]['group'] == "1" ? "selected" : ""; ?>>{{__('words.admin')}}</option>
                <option value="2" <?php echo $user[0]['group'] == "2" ? "selected" : ""; ?>>{{__('words.casher')}}</option>
                <option value="2" <?php echo $user[0]['group'] == "3" ? "selected" : ""; ?>>{{__('words.content')}}</option>
              </select>
            </div>
            <div class="mb-3 col-md-12">
              <label for="language" class="form-label">{{__('words.status')}}</label>
              <select id="language" name="status" class="select2 form-select">
                <option value="1" <?php echo $user[0]['status'] == "1" ? "selected" : ""; ?>>{{__('words.turn-on')}}</option>
                <option value="0" <?php echo $user[0]['status'] == "0" ? "selected" : ""; ?>>{{__('words.turn-off')}}</option>
              </select>
            </div>
          <div class="mt-2">
            <button type="submit" name="submit" class="btn btn-primary me-2">{{__('words.save')}}</button>
            <a href="/{{$lang}}/admin/users">
              <button type="button" class="btn btn-outline-secondary">{{__('words.cancel')}}</button>
            </a>
          </div>
        </form>
      </div>
      <!-- /Account -->
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
            <p class="mb-0">Пользователь успешно добавлен, перейдите во все пользователи для просмотра</p>
          </div>
        </div> 
      </div>
    </div> -->
  </div>
@endsection
