<?php

namespace App\Http\Controllers\museum;

use App\Providers\MenuServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Tariffs;
use App\Models\TariffPrices;
use App\Models\Tickets;
use Illuminate\Pagination\Paginator;

class Tariff extends Controller
{
  public function index(string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    Paginator::useBootstrap();
    $tariffs = Tariffs::orderBy('updated_at','DESC')->paginate(10);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

    App::setLocale($lang);
    return view('admin.tariff.tariff-list', ['lang'=>$lang, 'tariffs'=>$tariffs]);
  }

  public function addTariff(Request $req, string $lang)
  { 
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }

    App::setLocale($lang);
    $req->validate(
      [
        'tm_name' => 'required',
        'ru_name' => 'required',
        'eng_name' => 'required',
        'price1' => 'required | numeric',
        'sort' => 'required | numeric',
      ],
      [
        'tm_name.required' => __('words.error-field'),
        'ru_name.required' => __('words.error-field'),
        'eng_name.required' => __('words.error-field'),
        'price1.required' => __('words.error-field'),
        'price1.numeric' => __('words.error-field-number'),
        'sort.required' => __('words.error-field'),
        'sort.numeric' => __('words.error-field-number'),
      ]
    );

    $promo = $req->promo;
    if($promo != ""){
      $promo = 1;
    } else {
      $promo = 0;
    }

    $tariff = new Tariffs;
    $tariff->tm_name = $req->tm_name;
    $tariff->ru_name = $req->ru_name;
    $tariff->eng_name = $req->eng_name;
    $tariff->comment = $req->comment;
    $tariff->sort = $req->sort;
    $tariff->status = $req->status;
    $tariff->promo = $promo;
    $tariff->save();
    $tariffId = $tariff->id;

    $tariffPrice = new TariffPrices;
    $tariffPrice->tariff_id = $tariffId;
    $tariffPrice->currency_id = $req->price1type;
    $tariffPrice->price = $req->price1;
    $tariffPrice->save();

    if($req->price2 != ""){
      $tariffPrice2 = new TariffPrices;
      $tariffPrice2->tariff_id = $tariffId;
      $tariffPrice2->currency_id = $req->price2type;
      $tariffPrice2->price = $req->price2;
      $tariffPrice2->save();
    }
    if($req->price3 != ""){
      $tariffPrice3 = new TariffPrices;
      $tariffPrice3->tariff_id = $tariffId;
      $tariffPrice3->currency_id = $req->price3type;
      $tariffPrice3->price = $req->price3;
      $tariffPrice3->save();
    }

    return redirect('/'.$lang.'/admin/tariffs');
  }
  
  public function editTariff(Request $req, string $lang, string $tariffId)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    $req->validate(
      [
        'tm_name' => 'required',
        'ru_name' => 'required',
        'eng_name' => 'required',
        'price1' => 'required | numeric',
        'sort' => 'required | numeric',
      ],
      [
        'tm_name.required' => __('words.error-field'),
        'ru_name.required' => __('words.error-field'),
        'eng_name.required' => __('words.error-field'),
        'price1.required' => __('words.error-field'),
        'price1.numeric' => __('words.error-field-number'),
        'sort.required' => __('words.error-field'),
        'sort.numeric' => __('words.error-field-number'),
      ]
    );

    $promo = $req->promo;
    if($promo != ""){
      $promo = 1;
    } else {
      $promo = 0;
    }

    $tariff = Tariffs::find($tariffId);
    $tariff->tm_name = $req->tm_name;
    $tariff->ru_name = $req->ru_name;
    $tariff->eng_name = $req->eng_name;
    $tariff->comment = $req->comment;
    $tariff->sort = $req->sort;
    $tariff->status = $req->status;
    $tariff->promo = $promo;
    $tariff->save();
    $tariffId = $tariff->id;

    $tariffPrice = TariffPrices::find($req->price1id);
    $tariffPrice->tariff_id = $tariffId;
    $tariffPrice->currency_id = $req->price1type;
    $tariffPrice->price = $req->price1;
    $tariffPrice->save();

    if($req->price2 != ""){
      $tariffPrice2 = TariffPrices::find($req->price2id);
      $tariffPrice2->tariff_id = $tariffId;
      $tariffPrice2->currency_id = $req->price2type;
      $tariffPrice2->price = $req->price2;
      $tariffPrice2->save();
    }
    if($req->price3 != ""){
      $tariffPrice3 = TariffPrices::find($req->price3id);
      $tariffPrice3->tariff_id = $tariffId;
      $tariffPrice3->currency_id = $req->price3type;
      $tariffPrice3->price = $req->price3;
      $tariffPrice3->save();
    }

    return redirect('/'.$lang.'/admin/tariffs');
  }

  public function deleteTariff(Request $req, string $lang, int $length){
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setlocale($lang);

    $validator = \Validator::make(request()->all(),[]);

    for ($i=0; $i < $length; $i++) { 
      $tar = "check".$i;
      if(isset($req->$tar)){
        $ticket = Tickets::where('tariff_id', $req->$tar)->get();
        if(!isset($ticket[0]['id'])){
          // echo "Delete - " . $req->$tar . "<br>";
          // return "Deleted";
          $tariff = Tariffs::find($req->$tar);
          $tariff->delete();
        } else {
          $validator->after(function ($validator) {
            $validator->errors()->add('deleted', 'Нельзя удалить тариф (У тарифа есть активные записи)');
          });
          $validator->validate();
        }
      }
    }
    return redirect('/'.$lang.'/admin/tariffs');
  }
}
