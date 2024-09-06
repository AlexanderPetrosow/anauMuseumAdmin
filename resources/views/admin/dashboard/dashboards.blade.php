@extends('layouts/contentNavbarLayout')

@section('title', __('words.dashboard-pg'))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

<div class="row">
      <h5 class=" m-0 me-2 mb-3">{{__('words.casher-report')}}</h5>
      @if(isset($kassir_sale[0]))
      @foreach($kassir_sale as $kassirs)
      <div class="col-2 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <div class="bg-primary text-center p-2 rounded-3">
                  <i class="bx bx-user text-white"></i>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">{{__('words.casher')}}</span>
            <h3 class="card-title mb-2">{{$kassirs->count}}</h3>
            <small class="fw-semibold">{{$kassirs->kassir_name}}</small>
          </div>
        </div>
      </div>
      @endforeach
      @else
        <h4 class="fs-4">{{__('words.not-info')}}</h4>
      @endif
  </div>  
  <!-- Cassir -->
  
  <!-- Total Revenue -->
<div class="row">
  {{-- Raiting --}}
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card h-100">
      <div class="row row-bordered g-0">
        <div class="col-md-12">
          <input type="hidden" id="hall_year" value="@foreach($hall_year as $hallYear){{$hallYear->hall}},@endforeach">
          <input type="hidden" id="hall_year_name" value="@foreach($hall_year_name as $hallYearName){{$hallYearName}},@endforeach">
          <h5 class="card-header m-0 me-2 pb-3">{{__('words.hall-viewing-rating')}}</h5>
          <div class="card-body @if(!isset($hall_year[0])) d-flex justify-content-center align-items-center @endif">
            @if(isset($hall_year[0]))
              <div id="totalRevenueChart" class="px-2"></div>
            @else
              <h4 class="fs-4">{{__('words.not-info')}}</h4>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- / Raiting --}}

  <!-- Transactions -->
  <div class="col-md-6 col-lg-4 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-start justify-content-between">
        <h5 class="m-0 me-2">{{__('words.exhibit-viewing-rating')}}</h5>
      </div>
      <div class="card-body @if(!isset($exhibit_year[0])) d-flex justify-content-center align-items-center @endif">
        @if(isset($exhibit_year[0]))
        <ul class="p-0 m-0">
          @php
            $i = 0;
          @endphp
          @foreach($exhibit_year as $exhibits)
          @if($exhibits->exhibit_id != 0)
          <li class="d-flex mb-4 pb-1">
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2 w-75">
                <small class="text-muted d-block mb-1">{{__('words.exhibits')}}</small>
                <h6 class="mb-0">{{$exhibit_year_name[$i]}}</h6>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <h6 class="mb-0">{{$exhibits->exhibit}}</h6> 
              </div>
            </div>
          </li>
          @endif
          @php
            $i++;
          @endphp
          @endforeach
        </ul>
        @else
          <h4 class="fs-4">{{__('words.not-info')}}</h4>
        @endif
      </div>
    </div>
  </div>
  <!--/ Transactions -->
</div>
<!--/ Total Revenue -->

<div class="row">
  <!-- Order Statistics -->
  <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-start justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">{{__('words.sales-report-selected-day')}}</h5>
        </div>    
        <div class="dropdown">
          <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end p-3"  aria-labelledby="orederStatistics">
            <form method="POST" action="/{{$lang}}/admin/dashboards">
              @csrf
              <div class="col">
                <span>{{__('words.statistic-period')}}</span>
                <div class="mt-3 mb-1 d-flex justify-content-between align-items-center">
                  <span>{{__('words.from')}} </span>
                  <input type="date" name="start_date" value="@php if (isset($_POST['start_date'])) echo $_POST['start_date']; @endphp">
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <span>{{__('words.to')}}</span>
                  <input type="date" name="end_date" value="@php if (isset($_POST['end_date'])) echo $_POST['end_date']; @endphp">
                </div>
                <div><input class="btn btn-sm btn-outline-primary mt-3" name="date_submit" value="{{__('words.send')}}" type="submit"></div>
              </div>  
            </form>                
          </div>
        </div> 
      </div>
      <div class="card-body @if(!isset($all_sale[0])) d-flex justify-content-center align-items-center @endif">
        <input type="hidden" id="all_sale" value="@foreach($all_sale as $allSale){{$allSale->count}},@endforeach">
        <input type="hidden" id="all_sale_name" value="@foreach($all_sale_name as $allSaleName){{$allSaleName}},@endforeach">
        @if(isset($all_sale[0]))
        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
          <div class="d-flex flex-column align-items-center gap-1">
            @php $total = 0; @endphp
            @for($n=0; $n < count($all_sale); $n++)
            @php 
              $total += $all_sale[$n]->count; 
            @endphp
            @endfor
            <h2 class="mb-2">{{$total}}</h2>
            <span>{{__('words.general')}}</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
          @php $i = 0; @endphp
          @foreach($all_sale as $sales)
          <li class="d-flex mb-4 pb-1">
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">{{$all_sale_name[$i]}}</h6>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">{{$sales->count}}</small>
              </div>
            </div>
          </li>
          @php $i++; @endphp
          @endforeach
        </ul>
      @else
        <h4 class="fs-4">{{__('words.not-info')}}</h4>
      @endif
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->

  <!-- Expense Overview -->
  <div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <div class="card-title">
          <h5 class="m-0 me-2">{{__('words.sales-report-by-period')}}</h5>
        </div>    
      </div>
      <div class="card-body px-0 @if(!isset($week_sale_year[0])) d-flex justify-content-center align-items-center @endif">
        @if(isset($week_sale_year[0]))
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <input type="hidden" id="week_sales" value="@foreach($week_sale_year as $weekSale){{$weekSale->count}},@endforeach">
            <input type="hidden" id="week_days" value="@foreach($week_sale_year as $weekSale){{$weekSale->weeks}},@endforeach">
            <div id="incomeChart" class="pt-5"></div>
          </div>
        </div>
        @else
        <h4 class="fs-4">{{__('words.not-info')}}</h4>
        @endif
      </div>
    </div>
  </div>
  <!--/ Expense Overview -->

  <!-- Month Sale Overview -->
  <div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">{{__('words.report-on-sales-mothly')}}</h5>
        </div>    
      </div>
      <input type="hidden" id="month_sales" value="@foreach($month_sale as $monthSale){{$monthSale->count}},@endforeach">
      <input type="hidden" id="month_sales_name" value="@foreach($month_sale_name as $monthSaleName){{$monthSaleName}},@endforeach">
      <div class="card-body px-0 @if(!isset($month_sale[0])) d-flex justify-content-center align-items-center @endif">
        @if(isset($month_sale[0]))
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div id="incomeChart"></div>
            <div class="d-flex justify-content-start pt-2 gap-2">
              <div class="flex-shrink-0">
                <div id="monthTicketSale"></div>
              </div>
            </div>
          </div>
        </div>
        @else
        <h4 class="fs-4">{{__('words.not-info')}}</h4>
        @endif
      </div>
    </div>
  </div>
  <!--/ Month Sale Overview -->

  <!-- Year Sale Overview -->
  <div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">{{__('words.report-on-sales-yearly')}}</h5>
        </div>    
      </div>
      <input type="hidden" id="year_sales" value="@foreach($year_sale as $yearSale){{$yearSale->count}},@endforeach">
      <input type="hidden" id="year_sales_name" value="@foreach($year_sale_name as $yearSaleName){{$yearSaleName}},@endforeach">
      <div class="card-body px-0 @if(!isset($year_sale[0])) d-flex justify-content-center align-items-center @endif">
        @if(isset($year_sale[0]))
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div id="incomeChart"></div>
            <div class="d-flex justify-content-start pt-2 gap-2">
              <div class="flex-shrink-0">
                <div id="yearTicketSale"></div>
              </div>
            </div>
          </div>
        </div>
        @else
        <h4 class="fs-4">{{__('words.not-info')}}</h4>
        @endif
      </div>
    </div>
  </div>
  <!--/ Year Sale Overview -->

  <!-- Total Revenue -->
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card h-100">
      <div class="row row-bordered g-0">
        <input type="hidden" id="visit_hour" value="@foreach($visit_hours_year as $visitHour){{$visitHour->hour}},@endforeach">
        <input type="hidden" id="visit_visits" value="@foreach($visit_hours_year as $visitHour){{$visitHour->count}},@endforeach">
        <div class="col-md-12">
          <h5 class="card-header m-0 me-2 pb-3">{{__('words.statistics-daily-visits')}}</h5>
          <div class="card-body @if(!isset($visit_hours_year[0])) d-flex justify-content-center align-items-center @endif">
            @if(isset($visit_hours_year[0]))
              <div id="total2RevenueChart" class="px-2"></div>
            @else
            <h4 class="fs-4">{{__('words.not-info')}}</h4>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Revenue -->
</div>
</div>
<script>
  // Words
  var wViews = "{{__('words.views')}}";
  var wVisits = "{{__('words.visits')}}";
  var wSold = "{{__('words.sold')}}";
  var wTariff = "{{__('words.tariffs')}}";

  // Week days lang
  var mon = "{{__('words.mon')}}";
  var tue = "{{__('words.tue')}}";
  var wed = "{{__('words.wed')}}";
  var thur = "{{__('words.thur')}}";
  var fri = "{{__('words.fri')}}";
  var satur = "{{__('words.satur')}}";
  var sun = "{{__('words.sun')}}";
  
  // All Sale 
  var as = document.getElementById('all_sale').value;
  var aSales = as.split(",");
  aSales.pop();
  var all_sale = aSales;
  for (let index = 0; index < all_sale.length; index++) {
    all_sale[index] = parseInt(all_sale[index]);
  }
  var asn = document.getElementById('all_sale_name').value;
  var aSalesName = asn.split(",");
  aSalesName.pop();
  var all_sale_name = aSalesName;
  // --  All Sale
  
  // Year Hall Views 
  var yhv = document.getElementById('hall_year').value;
  var yHViews = yhv.split(",");
  yHViews.pop();
  var hall_year = yHViews;
  var yhvn = document.getElementById('hall_year_name').value;
  var yHViewsName = yhvn.split(",");
  yHViewsName.pop();
  var hall_year_name = yHViewsName;
  // --  Year Hall Views

  // Month Ticket Sale 
  var mts = document.getElementById('month_sales').value;
  var mSales = mts.split(",");
  mSales.pop();
  var month_sales = mSales;
  var mtsn = document.getElementById('month_sales_name').value;
  var mSalesName = mtsn.split(",");
  mSalesName.pop();
  var month_sales_name = mSalesName;
  // --  Month Ticket Sale

  // Visit Hour 
  var vh = document.getElementById('visit_hour').value;
  var vHour = vh.split(",");
  vHour.pop();
  var visit_hours = vHour;
  var vv = document.getElementById('visit_visits').value;
  var vVisit = vv.split(",");
  vVisit.pop();
  var visit_visits = vVisit;
  // --  Visit Hour
  
  // Week sale 
  var ws = document.getElementById('week_sales').value;
  var wSale = ws.split(",");
  wSale.pop();
  var week_sales = wSale;
  var wd = document.getElementById('week_days').value;
  var wDays = wd.split(",");
  wDays.pop();
  var week_days = wDays;
  // --  Week sale

  // Year Ticket Sale 
  var yts = document.getElementById('year_sales').value;
  var ySales = yts.split(",");
  ySales.pop();
  var year_sales = ySales;
  var ytsn = document.getElementById('year_sales_name').value;
  var ySalesName = ytsn.split(",");
  ySalesName.pop();
  var year_sales_name = ySalesName;
  // --  Year Ticket Sale
</script>
@endsection
