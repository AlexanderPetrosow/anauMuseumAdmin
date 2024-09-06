@extends('layouts/contentNavbarLayout')

@section('title', __('words.edit-tariff-pg'))

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">{{__('words.tariffs')}} /</span> {{__('words.edit-tariff')}}
</h4>

<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">{{__('words.detail-tariff')}}</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" action="/{{$lang}}/admin/edit-tariff/{{$tariff[0]['id']}}" method="POST">
          @csrf
          <div class="row">
            <div class="mb-1 col-lg-12 col-md-6">              
               <label for="firstName" class="form-label">{{__('words.rename')}}</label> 
              <div class="input-group">
              <input class="form-control" type="text" id="firstName" name="tm_name" placeholder="{{__('words.write-name')}}" value="{{$tariff[0]['tm_name']}}" autofocus />
              <span class="input-group-btn">
              <span class="btn-icon currency-green ">
                <span>TM</span>
              </span>
            </div>
            <span class="text-danger">@error('tm_name'){{$message}}@enderror<span>
          </div>
          <div class="mb-1 col-lg-12 col-md-6">              
            <!-- <label for="firstName" class="form-label">Наименование</label> -->
            <div class="input-group">
            <input class="form-control" type="text" id="firstName" name="ru_name" placeholder="{{__('words.write-name')}}" value="{{$tariff[0]['ru_name']}}" autofocus />
            <span class="input-group-btn">
            <span class="btn-icon currency-blue ">
              <span>RU</span>
            </span>
            </div>
            <span class="text-danger">@error('ru_name'){{$message}}@enderror<span>
          </div>
            <div class="mb-3 col-lg-12 col-md-6">              
              {{-- <label for="firstName" class="form-label">Наименование</label> --}}
              <div class="input-group">
              <input class="form-control" type="text" id="firstName" name="eng_name" placeholder="{{__('words.write-name')}}" value="{{$tariff[0]['eng_name']}}" autofocus="">
              <span class="input-group-btn">
              <span class="btn-icon currency-usa">
                <span>EN</span>
              </span>
              </span>
            </div>
            <span class="text-danger">@error('eng_name'){{$message}}@enderror<span>
            </div>
            <div class="mb-3 col-lg-12 col-md-6">              
              <label for="firstName" class="form-label">{{__('words.price-add')}}</label>
              {{-- NEW Price --}}
              @for($i = 0; $i < count($tariffPrices); $i++)
              <div class="input-group mt-1" id="currency{{$i+1}}">
                <div class="input-group-prepend ">
                  <div class="btn-group">
                    <select id="currencySelect{{$i+1}}" name="price{{$i+1}}type" class="btn currencyBox rounded-start card-currency">
                      @foreach($currencies as $currency)
                      @if($currency['id'] == $tariffPrices[$i]['currency_id'])
                      <option value="{{ $currency['id'] }}" selected>{{ $currency['name'] }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>            
                <input class="form-control" type="text" id="firstName" name="price{{$i+1}}" placeholder="30" value="{{$tariffPrices[$i]['price']}}" autofocus />
                <input type="hidden" name="price{{$i+1}}id" value="{{$tariffPrices[$i]['id']}}" autofocus />
              </div>
              @endfor
              <span class="text-danger">@error('price1'){{$message}}@enderror<span>
              {{-- Price --}}
              <!-- <div class="input-group" id="currency1">
                <div class="input-group-prepend ">
                  <div class="btn-group">
                    <select id="currencySelect1" name="price1type" class="btn currencyBox rounded-start card-currency">
                      @foreach($currencies as $currency)
                      @if($currency['id'] == 1)
                      <option value="{{ $currency['id'] }}" selected>{{ $currency['name'] }}</option>
                      @else
                      <option value="{{ $currency['id'] }}">{{ $currency['name'] }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>            
                <input class="form-control" type="text" id="firstName" name="price1" placeholder="30" autofocus />
                <span class="input-group-btn">
                  <button type="button" id="addCurrency1" class="btn-icon bordered-btn fs-2">
                    <span>+</span>
                  </button>
                </span>
              </div>
              <span class="text-danger">@error('price1'){{$message}}@enderror<span> -->
              {{-- Price --}}
              <!-- <div class="input-group mt-1 dnone" id="currency2">
                <div class="input-group-prepend ">
                  <div class="btn-group">
                    <select id="currencySelect2" name="price2type" class="btn currencyBox rounded-start card-currency">
                      @foreach($currencies as $currency)
                      <option value="{{ $currency['id'] }}">{{ $currency['name'] }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>            
                <input class="form-control" type="text" id="firstName" name="price2" placeholder="30" autofocus />
              </div> -->
              {{-- Price --}}
              <!-- <div class="input-group mt-1 dnone" id="currency3">
                <div class="input-group-prepend ">
                  <div class="btn-group">
                    <select id="currencySelect3" name="price3type" class="btn currencyBox rounded-start card-currency">
                      @foreach($currencies as $currency)
                      <option value="{{ $currency['id'] }}">{{ $currency['name'] }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>            
                <input class="form-control" type="text" id="firstName" name="price3" placeholder="30" autofocus />
              </div> -->
            </div>
            <div class="mb-3 col-lg-12 col-md-6">
              <label for="organization" class="form-label">{{__('words.notes')}}</label>
              <input type="text" name="comment" class="form-control" id="organization" value="{{$tariff[0]['comment']}}" name="organization" />
            </div>
            <div class="mb-3 col-lg-12 col-md-6">
              <label class="form-label" for="phoneNumber">{{__('words.sorting')}}</label>
              <div class="input-group input-group-merge">
                <!-- <span class="input-group-text">US (+1)</span> -->
                <input type="text" id="Number" name="sort" class="form-control" placeholder="0" value="{{$tariff[0]['sort']}}" />
              </div>
              <span class="text-danger">@error('sort'){{$message}}@enderror<span>
            </div>  
            <div class="col-12 mb-3">
            <label for="firstName" class="form-label">{{__('words.status')}}</label>
                  <select name="status" id="input-status" class="form-control">
                   <option value="1" <?php echo $tariff[0]['status'] == 1 ? "selected" : ""; ?>>{{__('words.turn-on')}}</option>
                   <option value="0" <?php echo $tariff[0]['status'] == 0 ? "selected" : ""; ?>>{{__('words.turn-off')}}</option>
                  </select>
            </div>
            <label class="mb-3 px-3 col-12">
              <input class="form-check-input me-1" name="promo" type="checkbox" <?php echo $tariff[0]['promo'] == 1 ? "checked" : ""; ?>>
              {{__('words.sale')}}
            </label>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">{{__('words.save')}}</button>
            <a href="/{{$lang}}/admin/tariffs">
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
          <p class="mb-0">Тариф успешно добавлен, перейдите во все тарифы для просмотра</p>
        </div>
      </div>
    </div>
  </div> -->
</div>

<style>

</style>

<script>
  $(document).ready(function(){
    $('#addCurrency1').click(function(){
      var sel1 = $('#currencySelect1').find(":selected").val();
      var sel2 = $('#currencySelect2').find(":selected").val();
      if($('#currency2').hasClass('dnone')){
        $('#currency2').removeClass('dnone');
        var a = parseInt(sel1) +1;
        for (let index = 1; index < 4; index++) {
          $('#currencySelect'+index+'>option[value="'+sel1+'"]').addClass('dnone');
          $('#currencySelect1>option[value="'+index+'"]').addClass('dnone');
        }
        $('#currencySelect1>option[value="'+sel1+'"]').removeClass('dnone');
        $('#currencySelect2>option[value="'+a+'"]').attr('selected','selected');
        if(!$('#currency2').hasClass('dnone') && !$('#currency3').hasClass('dnone')){
          $(this).addClass('dnone');
        }
      } else {
        $('#currency3').removeClass('dnone');
        var a = parseInt(sel2) +1;
        if(sel1 == 3 && sel2 == 2){
          a = 1;
        } else if(sel1 == 2 && sel2 == 1) {
          a = 3;
        } else if (sel1 == 3 && sel2 == 1) {
          a = 2;
        }
        for (let index = 1; index < 4; index++) {
          $('#currencySelect'+index+'>option[value="'+sel2+'"]').addClass('dnone');
          $('#currencySelect2>option[value="'+index+'"]').addClass('dnone');
          $('#currencySelect'+index+'>option[value="'+a+'"]').addClass('dnone');
        }
        $('#currencySelect2>option[value="'+sel2+'"]').removeClass('dnone');
        $('#currencySelect3>option[value="'+a+'"]').attr('selected','selected');
        $('#currencySelect3>option[value="'+a+'"]').removeClass('dnone');
        if(!$('#currency2').hasClass('dnone') && !$('#currency3').hasClass('dnone')){
          $(this).addClass('dnone');
        }
      }
    });
    // $('#addCurrency2').click(function(){
    //   var sel2 = $('#currencySelect2').find(":selected").val();
    //   for (let index = 1; index < 4; index++) {
    //     $('#currencySelect'+index+'>option[value="'+sel2+'"]').removeClass('dnone');
    //   }
    //   $('#currency2').addClass('dnone');
    //   if($('#addCurrency1').hasClass('dnone')){
    //     $('#addCurrency1').removeClass('dnone');
    //   }
    // });
    // $('#addCurrency3').click(function(){
    //   var sel3 = $('#currencySelect3').find(":selected").val();
    //   for (let index = 1; index < 4; index++) {
    //     $('#currencySelect'+index+'>option[value="'+sel3+'"]').removeClass('dnone');
    //   }
    //   $('#currency3').addClass('dnone');
    //   if($('#addCurrency1').hasClass('dnone')){
    //     $('#addCurrency1').removeClass('dnone');
    //   }
    // });
  });
</script>

@endsection
