<!-- Loading -->
<div class="loading-page loading-spin position-absolute spinner-grow dnone" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="loading-page loading-bg position-absolute w-100 h-100 dnone"></div>
@extends('layouts/contentNavbarLayout') @section('title', __('words.edit-exhibit-pg')) @section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection @section('content')

<style>
  audio::-webkit-media-controls-panel {
  background: white;
}
</style>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">{{__('words.exhibits')}} /</span> {{__('words.edit-exhibit')}}
</h4>
<form action="/{{$lang}}/admin/edit-exhibit/{{$exhibit[0]['id']}}" method="POST" enctype="multipart/form-data">
  @csrf
<div class="row">
  <div class="col-12">
  <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item" id="tm-btn">
        <span class="nav-link active">
          <img src="/assets/img/icons/unicons/tm-flag.png" width="20">  
          {{__('words.turkmen')}}
        </span>
      </li>
      <li class="nav-item" id="ru-btn">
        <span class="nav-link">
          <img src="/assets/img/icons/unicons/ru-flag.png" width="20">  
          {{__('words.russian')}}
        </span>
      </li>
      <li class="nav-item" id="eng-btn">
        <span class="nav-link">
          <img src="/assets/img/icons/unicons/en-flag.png" width="20"> 
          {{__('words.english')}}
        </span>
      </li>
    </ul>
  </div>
  @if($errors->any())
  <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
    @foreach($errors->all() as $err)
    <span>{{$err}}; </span>
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="col-md-6" h-75>
    <div class="card mb-4">
      <hr class="my-0" />
      {{-- tm-card-info --}}
        <div class="card-body info-cards" id="tm-card">
          <div class="row">
            <div class="mb-3 col-md-12">
              <label for="firstName" class="form-label">{{__('words.rename')}}</label>
              <input class="form-control" type="text" id="firstName" name="tm_name" placeholder="{{__('words.write-name')}}" value="{{$exhibit[0]['tm_name']}}" autofocus/>
              <span class="text-danger">@error('tm_name'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-md-12">
              <label for="lastName" class="form-label">{{__('words.comments')}}</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="tm_description" rows="3" placeholder="Введите {{__('words.comments')}}">{{$exhibit[0]['tm_description']}}</textarea>
              <span class="text-danger">@error('tm_description'){{$message}}@enderror<span>
            </div>
            <div class="col-md-12 mb-3">
              <label for="formFile" class="form-label">{{__('words.audio')}}</label>
              @if(isset($exhibit[0]['tm_audio'])) <audio controls="true" class="w-100 form-control" controlsList="nodownload" src="{{asset('storage/'.$exhibit[0]['tm_audio'])}}"></audio> @endif
              <input class="form-control" type="file" name="tm_audio" id="formFile" accept="audio/*">
              <span class="text-danger">@error('tm_audio'){{$message}}@enderror<span>
            </div>
          </div>
        </div>
        {{-- ru-card-info --}}
        <div class="card-body info-cards dnone" id="ru-card">
          <div class="row">
            <div class="mb-3 col-md-12">
              <label for="firstName" class="form-label">{{__('words.rename')}}</label>
              <input class="form-control" type="text" id="firstName" name="ru_name" placeholder="{{__('words.write-name')}}" value="{{$exhibit[0]['ru_name']}}" autofocus/>
              <span class="text-danger">@error('ru_name'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-md-12">
              <label for="lastName" class="form-label">{{__('words.comments')}}</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="ru_description" rows="3" placeholder="Введите {{__('words.comments')}}">{{$exhibit[0]['ru_description']}}</textarea>
              <span class="text-danger">@error('ru_description'){{$message}}@enderror<span>
            </div>
            <div class="col-md-12 mb-3">
              <label for="formFile" class="form-label">{{__('words.audio')}}</label>
              @if(isset($exhibit[0]['ru_audio'])) <audio controls="true" class="w-100 form-control" controlsList="nodownload" src="{{asset('storage/'.$exhibit[0]['ru_audio'])}}"></audio> @endif
              <input class="form-control" type="file" name="ru_audio" id="formFile" accept="audio/*">
              <span class="text-danger">@error('ru_audio'){{$message}}@enderror<span>
            </div>
          </div>
        </div>
        {{-- eng-card-info --}}
        <div class="card-body info-cards dnone" id="eng-card">
          <div class="row">
            <div class="mb-3 col-md-12">
              <label for="firstName" class="form-label">{{__('words.rename')}}</label>
              <input class="form-control" type="text" id="firstName" name="eng_name" placeholder="{{__('words.write-name')}}" value="{{$exhibit[0]['eng_name']}}" autofocus/>
              <span class="text-danger">@error('eng_name'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-md-12">
              <label for="lastName" class="form-label">{{__('words.comments')}}</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="eng_description" rows="3" placeholder="{{__('words.comments')}}">{{$exhibit[0]['eng_description']}}</textarea>
              <span class="text-danger">@error('eng_description'){{$message}}@enderror<span>
            </div>
            <div class="col-md-12 mb-3">
              <label for="formFile" class="form-label">{{__('words.audio')}}</label>
              @if(isset($exhibit[0]['eng_audio'])) <audio controls="true" class="w-100 form-control" controlsList="nodownload" src="{{asset('storage/'.$exhibit[0]['eng_audio'])}}"></audio> @endif
              <input class="form-control" type="file" name="eng_audio" id="formFile" accept="audio/*">
              <span class="text-danger">@error('eng_audio'){{$message}}@enderror<span>
            </div>
          </div>
        </div>
    </div>
    <!-- /Account -->
  </div>
  <div class="col-md-6 h-75">
    <div class="card mb-4">
      <!-- Account -->
      <hr class="my-0" />
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-12">
              <label for="hall" class="form-label">{{__('words.hall')}}</label>
              <select id="hall" name="hall" class="select2 form-select">
                <option <?php echo count($halls) != 0 ? "hidden" : ""; ?> value="">{{__('words.select-hall')}}</option>
                @foreach($halls as $hall)
                <option value="{{$hall['id']}}" <?php echo $exhibit[0]['hall_id'] == $hall['id'] ? "selected" : ""; ?>>{{$hall[$lang.'_name']}}</option>
                @endforeach
              </select>
              <span class="text-danger">@error('hall'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-md-12">
              <label for="exposure" class="form-label">{{__('words.exposure')}}</label>
              <select id="exposure" name="exposure" class="select2 form-select">
                <option value="">{{__('words.select-exposure')}}ю</option>
                @foreach($exposures as $exposure)
                <option value="{{$exposure['id']}}" <?php echo $exhibit[0]['exposure_id'] == $exposure['id'] ? "selected" : ""; ?>>{{$exposure[$lang.'_name']}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 mb-3 images">
              <div class="position-absolute dnone preview-img">
                <img class="rounded-3 w-50" src="{{asset('storage/'.$exhibit[0]['image'])}}" alt="">
              </div>
              <div class="d-flex justify-content-between">
                <label for="formFile" class="form-label">{{__('words.image')}}</label>
                @if($exhibit[0]['image'] != "") <div><i class="bx bx-image preview-img-icon" style="transform: scale(1)"></i>  <i class="bx bx-trash delete-img cursor-pointer" style="transform: scale(1)"></i></div>@endif
              </div>
              <input class="form-control" type="file" name="image" id="formFile" accept="image/*">
              <span class="text-danger">@error('image'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-md-12">
              <label for="firstName" class="form-label">{{__('words.sorting')}}</label>
              <input class="form-control" type="text" id="sort" name="sort" placeholder="0" value="{{$exhibit[0]['sort']}}" autofocus/>
              <span class="text-danger">@error('sort'){{$message}}@enderror<span>
            </div>
            <div class="col-12 mb-3">
            <label for="firstName" class="form-label">{{__('words.status')}}</label>
              <select name="status" id="input-status" class="form-control">
                <option value="1" <?php echo $exhibit[0]['status'] == 1 ? "selected" : ""; ?>>{{__('words.turn-on')}}</option>
                <option value="0" <?php echo $exhibit[0]['status'] == 0 ? "selected" : ""; ?>>{{__('words.turn-off')}}</option>
              </select>
            </div>
            
            <div class="mt-5">
              <button type="submit" class="btn btn-primary me-2">
              {{__('words.save')}}
              </button>
              <a href="/{{$lang}}/admin/exhibits">
                <button type="button" class="btn btn-outline-secondary">
                {{__('words.cancel')}}
                </button>
              </a>
            </div>
          </div>
      </div>
    </div>
    <!-- /Account -->
  </div>
  <!-- <div class="col-lg-11 my-3">
  <div class="card align-bottom ">
  <h5 class="card-header">Сохранено</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning bg-successfull">
            <h6 class="alert-heading fw-bold mb-1">Добавлено успешно</h6>
            <p class="mb-0">Экспонат успешно добавлен, перейдите во все экспонаты для просмотра</p>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  </form>
</div>

  <script>
  $(document).ready(function(){
    // tm button
    $('#tm-btn').click(function(){
      // button active
      $('.nav-link').removeClass('active');
      $('#tm-btn>.nav-link').addClass('active');
      // Card show
      $('.info-cards').addClass('dnone');
      $('#tm-card').removeClass('dnone');
    });
    // ru button
    $('#ru-btn').click(function(){
      // button active
      $('.nav-link').removeClass('active');
      $('#ru-btn>.nav-link').addClass('active');
      // Card show
      $('.info-cards').addClass('dnone');
      $('#ru-card').removeClass('dnone');
    });
    // eng button
    $('#eng-btn').click(function(){
      // button active
      $('.nav-link').removeClass('active');
      $('#eng-btn>.nav-link').addClass('active');
      // Card show
      $('.info-cards').addClass('dnone');
      $('#eng-card').removeClass('dnone');
    });

    $('.preview-img-icon').hover(
      function(){
        $('.preview-img').css("display", "block");
      },
      function(){
        $('.preview-img').css("display", "none");
      },
    );

    $('.delete-img').click(function(){
      $('.preview-img-icon').css("display", "none");
      $('.images').append('<input type="hidden" name="image_del" value="delete">');
    });

    // Form submit
    $("form").submit(function(){
      $('.loading-page').removeClass('dnone');
    });
  });
</script>


@endsection
