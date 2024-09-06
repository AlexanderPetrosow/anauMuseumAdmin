<?php

namespace App\Http\Controllers\museum;

use App\Providers\MenuServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Exposures;
use App\Models\Exhibits;
use App\Models\Halls;
use Illuminate\Pagination\Paginator;

class Exposure extends Controller
{
  public function index(string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    Paginator::useBootstrap();
    $exposures = Exposures::orderBy('updated_at','DESC')->paginate(10);
    $halls_name = array();
    for ($i=0; $i < count($exposures); $i++) { 
      $halls = Halls::where('id',$exposures[$i]['hall_id'])->get();
      array_push($halls_name, $halls[0][$lang.'_name']);
    }
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }

    App::setLocale($lang);
    return view('admin.exposure.exposure-list', ['lang'=>$lang, 'exposures'=>$exposures, 'halls_name'=>$halls_name]);
  }

  public function addExposure(Request $req, string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }

    App::setLocale($lang);
    $req->validate(
      [
        'tm_name' => 'required',
        // 'tm_description' => 'required',
        // 'tm_audio' => 'required | file | max:10240 | mimes:mp3' ,
        'ru_name' => 'required',
        // 'ru_description' => 'required',
        // 'ru_audio' => 'required | file | max:10240 | mimes:mp3',
        'eng_name' => 'required',
        // 'eng_description' => 'required',
        // 'eng_audio' => 'required | file | max:10240 | mimes:mp3',
        'hall' => 'required',
        // 'image' => 'required | file | max:10240 | mimes:jpg,jpeg,bmp,png',
        // 'sort' => 'required | numeric',
      ],
      [
        'tm_name.required' => '(TM) '.__('words.error-name'),
        // 'tm_description.required' => '(TM) '.__('words.error-description'),
        // 'tm_audio.required' => '(TM) Выберите аудио',
        // 'tm_audio.mimes' => '(TM) Неправильный формат. Допустимый формат (mp3)',
        // 'tm_audio.max' => '(TM) Максимальный размер файла 10мб',
        // 'tm_audio.uploaded' => '(TM) Ошибка загрузки файла',
        'ru_name.required' => '(RU) '.__('words.error-name'),
        // 'ru_description.required' => '(RU) '.__('words.error-description'),
        // 'ru_audio.required' => '(RU) Выберите аудио',
        // 'ru_audio.mimes' => '(RU) Неправильный формат. Допустимый формат (mp3)',
        // 'ru_audio.max' => '(TM) Максимальный размер файла 10мб',
        // 'ru_audio.uploaded' => '(TM) Ошибка загрузки файла',
        'eng_name.required' => '(ENG) '.__('words.error-name'),
        // 'eng_description.required' => '(ENG) '.__('words.error-description'),
        // 'eng_audio.required' => '(ENG) Выберите аудио',
        // 'eng_audio.mimes' => '(ENG) Неправильный формат. Допустимый формат (mp3)',
        // 'eng_audio.max' => '(TM) Максимальный размер файла 10мб',
        // 'eng_audio.uploaded' => '(TM) Ошибка загрузки файла',
        'hall.required' => __('words.error-hall'),
        // 'image.required' => 'Выберите изображение',
        // 'image.mimes' => 'Неправильный формат. Допустимый формат (jpg, jpeg, png, bmp)',
        // 'image.max' => 'Максимальный размер файла 10мб',
        // 'image.uploaded' => 'Ошибка загрузки файла',
        // 'sort.required' => 'Заполните это поля',
        // 'sort.numeric' => 'Поля должно содержать только цифры',
      ]
    );

    $exposure = new Exposures;
    $exposure->hall_id = $req->hall;
    $exposure->tm_name = $req->tm_name;
    $exposure->ru_name = $req->ru_name;
    $exposure->eng_name = $req->eng_name;
    $exposure->tm_description = isset($req->tm_description) ? $req->tm_description : null;
    $exposure->ru_description = isset($req->tm_description) ? $req->ru_description : null;
    $exposure->eng_description = isset($req->tm_description) ? $req->eng_description : null;
    if(isset($req->tm_audio)){
      $exposure->tm_audio = $req->file('tm_audio')->store('public/exposure-tm-audio');
    }
    if(isset($req->ru_audio)){
      $exposure->ru_audio = $req->file('ru_audio')->store('public/exposure-ru-audio');
    }
    if(isset($req->eng_audio)){
      $exposure->eng_audio = $req->file('eng_audio')->store('public/exposure-eng-audio');
    }
    if(isset($req->image)){
      $exposure->image = $req->file('image')->store('public/exposure-image');
    }
    // $exposure->sort = $req->sort;
    $exposure->sort = 0;
    $exposure->status = $req->status;
    $exposure->save();
    return redirect('/'.$lang.'/admin/exposures');
  }
  
  public function editExposure(Request $req, string $lang, string $exposureId)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    $req->validate(
      [
        'tm_name' => 'required',
        // 'tm_description' => 'required',
        'ru_name' => 'required',
        // 'ru_description' => 'required',
        'eng_name' => 'required',
        // 'eng_description' => 'required',
        'hall' => 'required',
        // 'sort' => 'required | numeric',
      ],
      [
        'tm_name.required' => '(TM) '.__('words.error-name'),
        // 'tm_description.required' => '(TM) '.__('words.error-description'),
        'ru_name.required' => '(RU) '.__('words.error-name'),
        // 'ru_description.required' => '(RU) '.__('words.error-description'),
        'eng_name.required' => '(ENG) '.__('words.error-name'),
        // 'eng_description.required' => '(ENG) '.__('words.error-description'),
        'hall.required' => __('words.error-hall'),
        // 'sort.required' => 'Заполните это поля',
        // 'sort.numeric' => 'Поля должно содержать только цифры',
      ]
    );

    $exposure = Exposures::find($exposureId);
    $exposure->hall_id = $req->hall;
    $exposure->tm_name = $req->tm_name;
    $exposure->ru_name = $req->ru_name;
    $exposure->eng_name = $req->eng_name;
    $exposure->tm_description = isset($req->tm_description) ? $req->tm_description : null;
    $exposure->ru_description = isset($req->tm_description) ? $req->ru_description : null;
    $exposure->eng_description = isset($req->tm_description) ? $req->eng_description : null;
    if(isset($req->tm_audio)){
      $exposure->tm_audio = $req->file('tm_audio')->store('public/exposure-tm-audio');
    }
    if(isset($req->ru_audio)){
      $exposure->ru_audio = $req->file('ru_audio')->store('public/exposure-ru-audio');
    }
    if(isset($req->eng_audio)){
      $exposure->eng_audio = $req->file('eng_audio')->store('public/exposure-eng-audio');
    }
    if(isset($req->image)){
      $exposure->image = $req->file('image')->store('public/exposure-image');
    } else {
      if(isset($req->image_del)){
        $exposure->image = "";
      }
    }
    // $exposure->sort = $req->sort;
    $exposure->status = $req->status;
    $exposure->save();
    return redirect('/'.$lang.'/admin/exposures');
  }

  public function qrcode(string $lang, int $exposureId)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    $exposure = Exposures::where('id', $exposureId)->get();
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }

    App::setLocale($lang);
    return view('admin.exposure.qr-exposure', ['lang'=>$lang, 'exposure'=>$exposure, 'exposureId'=>$exposureId]);
  }

  public function allqrcode(string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    $exposure = Exposures::all();
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }

    App::setlocale($lang);
    return view('admin.exposure.qr-all-exposure', ['lang'=>$lang, 'exposure'=>$exposure]);
  }

  public function deleteExposure(Request $req, string $lang, int $length){
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setlocale($lang);

    $validator = \Validator::make(request()->all(),[]);

    for ($i=0; $i < $length; $i++) { 
      $exp = "check".$i;
      if(isset($req->$exp)){
        $exhibit = Exhibits::where('exposure_id', $req->$exp)->get();
        if(!isset($exhibit[0]['id'])){
          // echo "Delete - " . $req->$exp . "<br>";
          // return "Deleted";
          $exposure = Exposures::find($req->$exp);
          $exposure->delete();
        } else {
          $validator->after(function ($validator) {
            $validator->errors()->add('deleted', 'Нельзя удалить экспозицию (У экспозиции есть активные записи)');
          });
          $validator->validate();
        }
      }
    }
    return redirect('/'.$lang.'/admin/exposures');
  }
}
