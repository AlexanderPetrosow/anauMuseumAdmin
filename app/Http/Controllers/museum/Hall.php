<?php

namespace App\Http\Controllers\museum;

use App\Providers\MenuServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halls;
use App\Models\Exposures;
use App\Models\Exhibits;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;

class Hall extends Controller
{
  public function index(string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

    App::setLocale($lang);
    Paginator::useBootstrap();
    $data = Halls::orderBy('updated_at','DESC')->paginate(10);
    return view('admin.hall.hall-list', ['halls'=>$data, 'lang'=>$lang]);
  }

  public function addHall(Request $req, string $lang)
  {
    App::setLocale($lang);
    $req->validate(
      [
        'ru_name' => 'required',
        'tm_name' => 'required',
        'eng_name' => 'required',
      ],
      [
        'ru_name.required' => __('words.error-field'),
        'tm_name.required' => __('words.error-field'),
        'eng_name.required' => __('words.error-field'),
      ]
    );

    $hall = new Halls;
    $hall->ru_name = $req->ru_name;
    $hall->tm_name = $req->tm_name;
    $hall->eng_name = $req->eng_name;
    $hall->status = $req->status;
    $hall->save();
    return redirect('/'.$lang.'/admin/halls');
  }
  
  public function editHall(Request $req, string $lang, string $hallId)
  {
    App::setLocale($lang);
    $req->validate(
      [
        'ru_name' => 'required',
        'tm_name' => 'required',
        'eng_name' => 'required',
      ],
      [
        'ru_name.required' => __('words.error-field'),
        'tm_name.required' => __('words.error-field'),
        'eng_name.required' => __('words.error-field'),
      ]
    );

    $hall = Halls::find($hallId);
    $hall->ru_name = $req->ru_name;
    $hall->tm_name = $req->tm_name;
    $hall->eng_name = $req->eng_name;
    $hall->status = $req->status;
    $hall->save();
    return redirect('/'.$lang.'/admin/halls');
  }

  public function deleteHall(Request $req, string $lang, int $length){
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setlocale($lang);

    $validator = \Validator::make(request()->all(),[]);

    for ($i=0; $i < $length; $i++) { 
      $hal = "check".$i;
      if(isset($req->$hal)){
        $exposure = Exposures::where('hall_id', $req->$hal)->get();
        $exhibit = Exhibits::where('hall_id', $req->$hal)->get();
        if(!isset($exposure[0]['id']) && !isset($exhibit[0]['id'])){
          // echo "Delete - " . $req->$hal . "<br>";
          // return "Deleted";
          $hall = Halls::find($req->$hal);
          $hall->delete();
        } else {
          $validator->after(function ($validator) {
            $validator->errors()->add('deleted', 'Нельзя удалить зал (У зала есть активные записи)');
          });
          $validator->validate();
        }
      }
    }
    return redirect('/'.$lang.'/admin/halls');
  }
}
