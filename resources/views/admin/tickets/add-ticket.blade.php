@extends('layouts/contentNavbarLayout') @section('title',__('words.add-list-pg'))
@section('content')
<!-- <h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Билеты / </span> Connections
</h4> -->
<!-- <div class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Новый билет</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
             
</div> -->

<!-- <div class="card example-1 square scrollbar-secondary square thin">
  <div class="card-body">
    <h4 id="section1"><strong>Fourth title of the news</strong></h4>
    <p>Ad leggings keytar, brunch id art party dolor labore. Pitchfork yr enim lo-fi before they sold out
      qui. Tumblr farm-to-table bicycle rights whatever. Anim keffiyeh carles cardigan. Velit seitan
      mcsweeney's photo booth 3 wolf moon irure. Cosby sweater lomo jean shorts, williamsburg hoodie minim
      qui you probably haven't heard of them et cardigan trust fund culpa biodiesel wes anderson aesthetic.
      Nihil tattooed accusamus, cred irony biodiesel keffiyeh artisan ullamco consequat.</p>
  </div>
</div> -->

<style>
  .ticket{
    cursor: pointer;
  }
</style>

<form method="POST" action="/{{$lang}}/admin/add-ticket">
  @csrf
<div class="row justify-content-around">

  <div class="col-lg-7 col-md-7 col-sm-12  card mx-4 px-0 border-p">
    <h4 class="p-3">{{__('words.tickets')}}</h4>
    <div class="d-flex flex-column justify-content-between example-1 square scrollbar-secondary square thin">
        <table class="table table-bordered">
          <thead>
            <tr class="grey-table">
              <th scope="col "></th>
              <th scope="col ">{{__('words.rename')}}</th>
              <th scope="col">{{__('words.currency')}}</th>
              <th scope="col">{{__('words.price-add')}}</th>
              <th scope="col">{{__('words.quantity')}}</th>
              <th scope="col">{{__('words.total')}}</th>
            </tr>
          </thead>
            <tbody id="kassa-body"></tbody>
        </table>
      </div>
      <div>
        <div class="d-flex justify-content-between p-2 purple-bordered">
          <strong>{{__('words.total')}}</strong><strong class="totalPrice"></strong>
          <input type="hidden" id="counts" name="count" value="0">
          <input type="hidden" id="total_t" name="total_tmt" value="0">
          <input type="hidden" id="total_u" name="total_usd" value="0">
          <input type="hidden" id="total_e" name="total_euro" value="0">
          <input type="hidden" id="tickets" name="tickets[]" value="0">
        </div>
        <div class="row container pl-4 mt-3 mb-3 mx-0">
          <div class="col-4">
            <div class="row">
              <div class="col-6 p-0">
                <button type="button" class="plus w-100">
                  <span class="fs-1 text-white">+</span>
                </button>
              </div>
              <div class="col-6 p-0">
                <button type="button" class="minus w-100">
                  <span class="fs-1">-</span>
                </button>
              </div>
              <div class="col-12 p-0  mt-1">
                <button type="button" class="delete w-100">
                  <span class="fs-4">{{__('words.delete')}}</span>
                </button>
              </div>
            </div>
          </div>
          <div class="col-4 px-0 ps-3">
            <div class="col-12 p-0 h-100">
              <a href="/{{$lang}}/admin/tickets">
                <button type="button" class="cancel w-100 h-100">
                  <span class="fs-4">{{__('words.cancel')}}</span>
                </button>
              </a>
            </div>
          </div>
          <div class="col-4">
            <div class="col-12 p-0 h-100">
              <button type="submit" class="print w-100 h-100">
                <span class="fs-4">{{__('words.print')}}<br />{{__('words.tickets')}}</span>
              </button>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 card d-flex py-3 h-90">
    <div class="mb-12 col-md-12">
      <div class="row mb-5">
        @foreach($tariffs as $tariff)
        <div class="col-md-12 col-lg-6 mb-3">
          @if($tariff['promo'] == 1)
          <div class="card h-100 promo-card tariffss-card justify-content-between">
              @php
              $p = 0;
              @endphp
            @foreach($tariffPrices as $prices)
              @if($tariff['id'] == $prices['tariff_id'])
                @if($p == 0)
                  @foreach($currencies as $currency)
                    @if($prices['currency_id'] == $currency['id'])
            <div class="text-center pt-5 tariff-card" data-name="{{$tariff[$lang.'_name']}}" data-vallet="{{$currency['name']}}" data-price="{{$prices['price']}}" data-tariff-id="{{$tariff['id']}}" data-vallet-id="{{$currency['id']}}">
                    @endif  
                  @endforeach
                @php
                $p++;
                @endphp
                @endif
              @endif  
            @endforeach
              <h5 class="card-title promo-text">{{$tariff[$lang.'_name']}}</h5>
              @if(strlen($tariff['comment']) >= 12)
              <h6 title="{{$tariff['comment']}}" class="card-subtitle promo-text">{{mb_substr($tariff['comment'],0,12).'...'}}</h6>
              @else
              <h6 class="card-subtitle promo-text">{{$tariff['comment']}}</h6>
              @endif
            </div>
            <div class="d-flex pt-3 test">
              <div class="col-6">
                <div class="btn-group w-100">
                  <select class="btn currencyBox card-currency promo-select pricess">
                    @foreach($tariffPrices as $prices)
                      @if($tariff['id'] == $prices['tariff_id'])
                        @foreach($currencies as $currency)
                          @if($prices['currency_id'] == $currency['id'])
                            <option value="{{$prices['id']}}" data-names="{{$currency['name']}}">{{$currency['name']}}</option>
                          @endif  
                        @endforeach
                      @endif  
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-6">
                <select class="btn card-price currencyBox promo-text w-100 pricesss" disabled>
                  @foreach($tariffPrices as $prices)
                    @if($tariff['id'] == $prices['tariff_id'])
                      <option value="{{$prices['id']}}" data-prices="{{$prices['price']}}">{{$prices['price']}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          @else
          <div class="card h-100 card-purple tariffss-card">
          @php
              $p = 0;
              @endphp
            @foreach($tariffPrices as $prices)
              @if($tariff['id'] == $prices['tariff_id'])
                @if($p == 0)
                  @foreach($currencies as $currency)
                    @if($prices['currency_id'] == $currency['id'])
            <div class="text-center pt-5 tariff-card" data-name="{{$tariff[$lang.'_name']}}" data-vallet="{{$currency['name']}}" data-price="{{$prices['price']}}"  data-tariff-id="{{$tariff['id']}}" data-vallet-id="{{$currency['id']}}">
                    @endif  
                  @endforeach
                @php
                $p++;
                @endphp
                @endif
              @endif  
            @endforeach
              <h5 class="card-title">{{$tariff[$lang.'_name']}}</h5>
              @if(strlen($tariff['comment']) >= 18)
              <h6 class="card-subtitle text-muted">{{mb_substr($tariff['comment'],0,18).'...'}}</h6>
              @else
              <h6 class="card-subtitle text-muted">{{$tariff['comment']}}</h6>
              @endif
            </div>
            <div class="d-flex pt-3">
              <div class="col-6">
                <div class="btn-group w-100">
                  <select class="btn currencyBox card-currency pricess">
                    @foreach($tariffPrices as $prices)
                      @if($tariff['id'] == $prices['tariff_id'])
                        @foreach($currencies as $currency)
                          @if($prices['currency_id'] == $currency['id'])
                            <option value="{{$prices['id']}}" data-names="{{$currency['name']}}">{{$currency['name']}}</option>
                          @endif  
                        @endforeach
                      @endif  
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-6">
                <select class="btn card-price currencyBox w-100 pricesss" disabled>
                  @foreach($tariffPrices as $prices)
                    @if($tariff['id'] == $prices['tariff_id'])
                      <option value="{{$prices['id']}}" data-prices="{{$prices['price']}}">{{$prices['price']}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          @endif
        </div>
        @endforeach
      </div>
    </div>
  </div>
</form>
  <!-- Scripts -->
  <script>
    $(document).ready(function(){
      
      var n = 0;
      var tickets = [];
      $('.totalPrice').text("0 TMT");
      $('.pricess').change(function(){
        var price_id = $(this).val();
        if($('.pricesss option[value='+price_id+']').val() == price_id){
          $('.pricess option').removeAttr('selected');
          $('.pricesss option').removeAttr('selected');
          $(this).find('option[value='+price_id+']').attr('selected', 'selected');
          $('.pricesss option[value='+price_id+']').attr('selected', 'selected');
        }
      });
      // $('.pricess').trigger('change');
      $('.tariffss-card').click(function(){
        var vallet = $(this).find('.pricess :selected').data('names');
        var price = $(this).find('.pricesss :selected').data('prices');
        $(this).find('.tariff-card').attr('data-vallet', vallet);
        $(this).find('.tariff-card').attr('data-price', price);
      });

      $('.tariff-card').click(function(){
        total_tmt = 0;
        total_usd = 0;
        total_euro = 0;
        var name = this.getAttribute('data-name');
        var vallet = this.getAttribute('data-vallet');
        var price = this.getAttribute('data-price');
        var tariffId = this.getAttribute('data-tariff-id');
        var valletId = this.getAttribute('data-vallet-id');
        tickets.push(n);
        // // console.log(n +'. '+ name + ' - ' + vallet +' - '+ price +' - '+ tickets[0]);
        // // $("#kassa-body").append('<tr class="grey-table" id="ticket'+n+'"><td><input class="form-check-input me-1" id="checkbox'+n+'" type="checkbox"></td><td>'+name+'</td><td id="vallet'+n+'">'+vallet+'</td><td>'+price+'</td><td id="count'+n+'">1</td><td class="sum'+n+'">'+price+'</td></tr>');
        $("#kassa-body").append('<tr class="grey-table ticket" id="ticket'+n+'" data-id="'+n+'"><td><input class="form-check-input me-1 checkboxs" id="checkbox'+n+'" type="checkbox"><input type="hidden" name="tariffId_'+n+'" value="'+tariffId+'"><input type="hidden" name="currencyId_'+n+'" value="'+valletId+'"><input type="hidden" name="prices_'+n+'" value="'+price+'"><input type="hidden" id="tcount_'+n+'" name="count_'+n+'" value="1"></td><td>'+name+'</td><td id="vallet'+n+'">'+vallet+'</td><td id="tprice'+n+'">'+price+'</td><td id="count'+n+'">1</td><td id="sum'+n+'">'+price+'</td></tr>');
        // // $("#kassa-body").append('<div class="row ticket-cell'+n+'"><div class="col-1"><input class="form-check-input me-1 checkCell" type="checkbox"></div><div class="col-3">'+name+'</div><div class="col-2 vallet'+n+'">'+vallet+'</div><div class="col-2">'+price+'</div><div class="col-2">1</div><div class="col-2 sum'+n+'">'+price+'</div></div>');
        for (let index = 0; index <= tickets[tickets.length-1]; index++) {
          var vallets = $('#vallet'+index).text();
          var sum = $('#sum'+index).text();
          if(vallets != ""){
            sum = parseInt(sum);
            if(vallets == 'TMT'){
              total_tmt += sum;
              $('#total_t').attr('value',total_tmt);
            } else if(vallets == 'USD'){
              total_usd += sum;
              $('#total_u').attr('value',total_usd);
            } else if(vallets == 'EURO'){
              total_euro += sum;
              $('#total_e').attr('value',total_euro);
            }
            console.log(index +'. ' + vallets +' - '+ sum +' - '+ tickets[index]);
          }
        }
        
        $('#counts').attr('value',tickets.length);
        $('#tickets').attr('value',tickets);
        
        if(total_tmt != 0 && total_usd == 0 && total_euro == 0){
          $('.totalPrice').text(total_tmt+' TMT');
        } else if(total_tmt == 0 && total_usd != 0 && total_euro == 0){
          $('.totalPrice').text(total_usd+' USD');
        } else if(total_tmt == 0 && total_usd == 0 && total_euro != 0){
          $('.totalPrice').text(total_euro+' EURO');
        } else if(total_tmt == 0 && total_usd != 0 && total_euro != 0){
          $('.totalPrice').text(total_usd+' USD | '+ total_euro+' EURO');
        } else if(total_tmt != 0 && total_usd != 0 && total_euro == 0){
          $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD');
        } else if(total_tmt != 0 && total_usd == 0 && total_euro != 0){
          $('.totalPrice').text(total_tmt+' TMT | '+ total_euro+' EURO');
        } else if(total_tmt != 0 && total_usd != 0 && total_euro != 0){
          $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD | '+ total_euro+' EURO');
        } 
        //  // for (let index = 0; index < tickets.length; index++) {
        //  //   const element = tickets[index];
        //  //   console.log("Ticket: "+element);
        //  // }
        
        $('.ticket').click(function(){
          var id = $(this).data('id');
          // $(this).addClass('haha');
          // alert("hahaaa"+ id);
          $('.checkboxs').prop('checked', false);
          $(this).find('#checkbox'+id).prop('checked', true);
        });
        // $('input[type=checkbox]').change(function(){
          //   $('input[type=checkbox]').prop('checked', false);
          //   $(this).prop('checked', true); 
          // });
          
          
          // console.log("Length: "+tickets.length);
          
          $('.delete').click(function(){
            for (let index = 0; index < tickets.length; index++) {
              if ($('#checkbox'+tickets[index]).is(":checked")){
                $('#ticket'+tickets[index]).remove();
                tickets = $.grep(tickets, function(value) {
                  return value != tickets[index];
                });
                // console.log("Index: "+index+ " - N: - "+n+" - Ticket: - "+tickets[index]);
              }
            }

            total_tmt = 0;
            total_usd = 0;
            total_euro = 0;

            for (let index = 0; index <= tickets[tickets.length-1]; index++) {
              var vallets = $('#vallet'+index).text();
              var sum = $('#sum'+index).text();
              if(vallets != ""){
                sum = parseInt(sum);
                if(vallets == 'TMT'){
                  total_tmt += sum;
                  $('#total_t').attr('value',total_tmt);
                } else if(vallets == 'USD'){
                  total_usd += sum;
                  $('#total_u').attr('value',total_usd);
                } else if(vallets == 'EURO'){
                  total_euro += sum;
                  $('#total_e').attr('value',total_euro);
                }
                // console.log(index +'. ' + vallets +' - '+ sum +' - '+ tickets[index]);
              }
            }
            
            $('#counts').attr('value',tickets.length);
            $('#tickets').attr('value',tickets);
            
            if(total_tmt != 0 && total_usd == 0 && total_euro == 0){
              $('.totalPrice').text(total_tmt+' TMT');
            } else if(total_tmt == 0 && total_usd != 0 && total_euro == 0){
              $('.totalPrice').text(total_usd+' USD');
            } else if(total_tmt == 0 && total_usd == 0 && total_euro != 0){
              $('.totalPrice').text(total_euro+' EURO');
            } else if(total_tmt == 0 && total_usd != 0 && total_euro != 0){
              $('.totalPrice').text(total_usd+' USD | '+ total_euro+' EURO');
            } else if(total_tmt != 0 && total_usd != 0 && total_euro == 0){
              $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD');
            } else if(total_tmt != 0 && total_usd == 0 && total_euro != 0){
              $('.totalPrice').text(total_tmt+' TMT | '+ total_euro+' EURO');
            } else if(total_tmt != 0 && total_usd != 0 && total_euro != 0){
              $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD | '+ total_euro+' EURO');
            } 
            // console.log("TMT: "+total_tmt+"; USD: "+total_usd+"; EURO: "+total_euro);
            // console.log("Tickets: "+tickets);
            // console.log("Length: "+tickets.length);

          });
          
          // alert("N: "+n);
          n++;
        });
        
        $('.plus').click(function(){
          for (let index = 0; index < tickets.length; index++) {
            if ($('#checkbox'+tickets[index]).is(":checked")){
              var count = $('#count'+tickets[index]).text();
              var price = $('#tprice'+tickets[index]).text();
              count = parseInt(count); 
              price = parseInt(price); 
              count++;
              price *= count;
              $('#tcount_'+index).val(count);
              $('#count'+tickets[index]).text(count);
              $('#sum'+tickets[index]).text(price);
            }
          }
          

          total_tmt = 0;
          total_usd = 0;
          total_euro = 0;

          for (let index = 0; index <= tickets[tickets.length-1]; index++) {
            var vallets = $('#vallet'+index).text();
            var sum = $('#sum'+index).text();

            // Counts
            var counts = $('#tcount_'+index).val();

            if(vallets != ""){
              sum = parseInt(sum);
              if(vallets == 'TMT'){
                total_tmt += sum;
                $('#total_t').attr('value',total_tmt);
              } else if(vallets == 'USD'){
                total_usd += sum;
                $('#total_u').attr('value',total_usd);
              } else if(vallets == 'EURO'){
                total_euro += sum;
                $('#total_e').attr('value',total_euro);
              }
              // console.log(index +'. ' + vallets +' - '+ sum +' - '+ tickets[index]);
            }
          }
          
          $('#counts').attr('value',tickets.length);
          $('#tickets').attr('value',tickets);
          
          if(total_tmt != 0 && total_usd == 0 && total_euro == 0){
            $('.totalPrice').text(total_tmt+' TMT');
          } else if(total_tmt == 0 && total_usd != 0 && total_euro == 0){
            $('.totalPrice').text(total_usd+' USD');
          } else if(total_tmt == 0 && total_usd == 0 && total_euro != 0){
            $('.totalPrice').text(total_euro+' EURO');
          } else if(total_tmt == 0 && total_usd != 0 && total_euro != 0){
            $('.totalPrice').text(total_usd+' USD | '+ total_euro+' EURO');
          } else if(total_tmt != 0 && total_usd != 0 && total_euro == 0){
            $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD');
          } else if(total_tmt != 0 && total_usd == 0 && total_euro != 0){
            $('.totalPrice').text(total_tmt+' TMT | '+ total_euro+' EURO');
          } else if(total_tmt != 0 && total_usd != 0 && total_euro != 0){
            $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD | '+ total_euro+' EURO');
          } 
        });

        $('.minus').click(function(){
          for (let index = 0; index < tickets.length; index++) {
            if ($('#checkbox'+tickets[index]).is(":checked")){
              var count = $('#count'+tickets[index]).text();
              var price = $('#tprice'+tickets[index]).text();
              count = parseInt(count); 
              price = parseInt(price); 
              if(count > 1){
                count--;
                price *= count;
              }
              $('#tcount_'+index).val(count);
              $('#count'+tickets[index]).text(count);
              $('#sum'+tickets[index]).text(price);
            }
          }

          total_tmt = 0;
          total_usd = 0;
          total_euro = 0;

          for (let index = 0; index <= tickets[tickets.length-1]; index++) {
            var vallets = $('#vallet'+index).text();
            var sum = $('#sum'+index).text();
            if(vallets != ""){
              sum = parseInt(sum);
              if(vallets == 'TMT'){
                total_tmt += sum;
                $('#total_t').attr('value',total_tmt);
              } else if(vallets == 'USD'){
                total_usd += sum;
                $('#total_u').attr('value',total_usd);
              } else if(vallets == 'EURO'){
                total_euro += sum;
                $('#total_e').attr('value',total_euro);
              }
              // console.log(index +'. ' + vallets +' - '+ sum +' - '+ tickets[index]);
            }
          }
          
          $('#counts').attr('value',tickets.length);
          $('#tickets').attr('value',tickets);
          
          if(total_tmt != 0 && total_usd == 0 && total_euro == 0){
            $('.totalPrice').text(total_tmt+' TMT');
          } else if(total_tmt == 0 && total_usd != 0 && total_euro == 0){
            $('.totalPrice').text(total_usd+' USD');
          } else if(total_tmt == 0 && total_usd == 0 && total_euro != 0){
            $('.totalPrice').text(total_euro+' EURO');
          } else if(total_tmt == 0 && total_usd != 0 && total_euro != 0){
            $('.totalPrice').text(total_usd+' USD | '+ total_euro+' EURO');
          } else if(total_tmt != 0 && total_usd != 0 && total_euro == 0){
            $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD');
          } else if(total_tmt != 0 && total_usd == 0 && total_euro != 0){
            $('.totalPrice').text(total_tmt+' TMT | '+ total_euro+' EURO');
          } else if(total_tmt != 0 && total_usd != 0 && total_euro != 0){
            $('.totalPrice').text(total_tmt+' TMT | '+ total_usd+' USD | '+ total_euro+' EURO');
          } 
        });
      // $('.delete').click(function(){
      //   for (let index = 0; index < tickets.length; index++) {
      //     if (document.getElementById('checkbox'+tickets[index]).checked){
      //       document.getElementById('ticket'+tickets[index]).remove();
      //       tickets.splice(index, 1);
      //     }
      //   }
      //   console.log("Length: "+tickets.length);
      // });
    });
  </script>

  @endsection
</div>