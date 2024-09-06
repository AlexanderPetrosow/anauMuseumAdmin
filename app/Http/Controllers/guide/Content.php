<?php

namespace App\Http\Controllers\guide;

use App\Http\Controllers\Controller;
use App\Models\Statistics;
use App\Models\Tickets;
use App\Models\Exposures;
use App\Models\Exhibits;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class Content extends Controller
{
  public function index(string $lang, int $exposureId, int $exhibitId)
  {

    $license = file_get_contents(base_path('license'));
    if(Hash::check(trim($license), file_get_contents(base_path('.igitignore')))){
        // if (!session()->has('client')) {
        //   return redirect('/'.$lang.'/auth');
        // }
        $ticket = Tickets::where('id', session('client'))->get();
    } else {
      $ticket = [
        [
          'id'=>0,
          'tariff_id'=>5
        ]
        ,
      ];
    }
    App::setLocale($lang);


    if($exhibitId == 0){
      $exposure = Exposures::where('id', $exposureId)->where('status', 1)->get();
      $exhibit = Exhibits::where('exposure_id', $exposureId)->where('status', 1)->orderBy('sort', 'ASC')->get();

      if(isset($exposure[0]['id'])){

        $statistics = new Statistics;
        $statistics->ticket_id = $ticket[0]['id'];
        $statistics->tariff_id = $ticket[0]['tariff_id'];
        $statistics->hall_id = $exposure[0]['hall_id'];
        $statistics->exposure_id = $exposure[0]['id'];
        $statistics->exhibit_id = 0;
        $statistics->lang = $lang;
        $statistics->listen = 0;
        $statistics->listen_status = 0;
        $statistics->created_at = NOW();
        $statistics->save();
        
        return view('guide/collect', ['lang'=>$lang, 'exposure'=>$exposure, 'exhibit'=>$exhibit]);

      } else {
        abort(404);
      }
    } else {
      
      $exhibit = Exhibits::where('id', $exhibitId)->where('status', 1)->get();

      if(isset($exhibit[0]['id'])){
        $statistics = new Statistics;
        $statistics->ticket_id = $ticket[0]['id'];
        $statistics->tariff_id = $ticket[0]['tariff_id'];
        $statistics->hall_id = $exhibit[0]['hall_id'];
        $statistics->exposure_id = $exhibit[0]['exposure_id'];
        $statistics->exhibit_id = $exhibit[0]['id'];
        $statistics->lang = $lang;
        $statistics->listen = 0;
        $statistics->listen_status = 0;
        $statistics->save();
        
        return view('guide/object', ['lang'=>$lang, 'exposureId'=>$exposureId, 'exhibit'=>$exhibit]);  
      } else {
        abort(404);
      }

    }
  }  
}
