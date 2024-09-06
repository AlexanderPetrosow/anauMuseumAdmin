<?php

namespace App\Http\Controllers\museum;

use App\Providers\MenuServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Halls;
use App\Models\Exposures;
use App\Models\Exhibits;
use Illuminate\Pagination\Paginator;

class Exhibit extends Controller
{
  public function index(string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }

    App::setLocale($lang);
    Paginator::useBootstrap();
    $exhibits = Exhibits::orderBy('updated_at','DESC')->paginate(10);
    $halls_name = array();
    $exposures_name = array();
    for ($i=0; $i < count($exhibits); $i++) { 
      $halls = Halls::where('id',$exhibits[$i]['hall_id'])->get();
      array_push($halls_name, $halls[0][$lang.'_name']);
      
      if($exhibits[$i]['exposure_id'] != "0"){
        $exposures = Exposures::where('id',$exhibits[$i]['exposure_id'])->get();
        array_push($exposures_name, $exposures[0][$lang.'_name']);
      } else {
        array_push($exposures_name, __('words.empty'));
      }
    }
    return view('admin.exhibit.exhibit-list', ['lang'=>$lang, 'exhibits'=>$exhibits, 'halls_name'=>$halls_name, 'exposures_name'=>$exposures_name]);
  }

  public function addExhibit(Request $req, string $lang)
  {
    App::setLocale($lang);
    $req->validate(
      [
        'tm_name' => 'required',
        'tm_description' => 'required',
        // 'tm_audio' => 'required | file | max:10240 | mimes:mp3',
        'ru_name' => 'required',
        'ru_description' => 'required',
        // 'ru_audio' => 'required | file | max:10240 | mimes:mp3',
        'eng_name' => 'required',
        'eng_description' => 'required',
        // 'eng_audio' => 'required | file | max:10240 | mimes:mp3',
        'hall' => 'required',
        // 'image' => 'required | file | max:10240 | mimes:jpg,jpeg,bmp,png',
        'sort' => 'required | numeric',
      ],
      [
        'tm_name.required' => '(TM) '.__('words.error-name'),
        'tm_description.required' => '(TM) '.__('words.error-description'),
        // 'tm_audio.required' => '(TM) Выберите аудио',
        // 'tm_audio.mimes' => '(TM) Неправильный формат. Допустимый формат (mp3)',
        // 'tm_audio.max' => '(TM) Максимальный размер файла 10мб',
        // 'tm_audio.uploaded' => '(TM) Ошибка загрузки файла',
        'ru_name.required' => '(RU) '.__('words.error-name'),
        'ru_description.required' => '(RU) '.__('words.error-description'),
        // 'ru_audio.required' => '(RU) Выберите аудио',
        // 'ru_audio.mimes' => '(RU) Неправильный формат. Допустимый формат (mp3)',
        // 'ru_audio.max' => '(TM) Максимальный размер файла 10мб',
        // 'ru_audio.uploaded' => '(TM) Ошибка загрузки файла',
        'eng_name.required' => '(ENG) '.__('words.error-name'),
        'eng_description.required' => '(ENG) '.__('words.error-description'),
        // 'eng_audio.required' => '(ENG) Выберите аудио',
        // 'eng_audio.mimes' => '(ENG) Неправильный формат. Допустимый формат (mp3)',
        // 'eng_audio.max' => '(TM) Максимальный размер файла 10мб',
        // 'eng_audio.uploaded' => '(TM) Ошибка загрузки файла',
        'hall.required' => __('words.error-hall'),
        // 'image.required' => 'Выберите изображение',
        // 'image.mimes' => 'Неправильный формат. Допустимый формат (jpg, jpeg, png, bmp)',
        // 'image.max' => 'Максимальный размер файла 10мб',
        // 'image.uploaded' => 'Ошибка загрузки файла',
        'sort.required' => __('words.error-field'),
        'sort.numeric' => __('words.error-field-number'),
      ]
    );

    $exposure_id = 0;
    if (isset($req->exposure)) {
      $exposure_id = $req->exposure;
    }

    $exhibit = new Exhibits;
    $exhibit->hall_id = $req->hall;
    $exhibit->exposure_id = $exposure_id;
    $exhibit->tm_name = $req->tm_name;
    $exhibit->ru_name = $req->ru_name;
    $exhibit->eng_name = $req->eng_name;
    $exhibit->tm_description = $req->tm_description;
    $exhibit->ru_description = $req->ru_description;
    $exhibit->eng_description = $req->eng_description;
    if(isset($req->tm_audio)){
      $exhibit->tm_audio = $req->file('tm_audio')->store('public/exhibit-tm-audio');
    }
    if(isset($req->ru_audio)){
      $exhibit->ru_audio = $req->file('ru_audio')->store('public/exhibit-ru-audio');
    }
    if(isset($req->eng_audio)){
      $exhibit->eng_audio = $req->file('eng_audio')->store('public/exhibit-eng-audio');
    }
    if(isset($req->image)){
      $exhibit->image = $req->file('image')->store('public/exhibit-image');
    }
    $exhibit->sort = $req->sort;
    $exhibit->status = $req->status;
    $exhibit->save();
    return redirect('/'.$lang.'/admin/exhibits');
  }
  
  public function editExhibit(Request $req, string $lang, string $exhibitId)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    $req->validate(
      [
        'tm_name' => 'required',
        'tm_description' => 'required',
        'ru_name' => 'required',
        'ru_description' => 'required',
        'eng_name' => 'required',
        'eng_description' => 'required',
        'hall' => 'required',
        'sort' => 'required | numeric',
      ],
      [
        'tm_name.required' => '(TM) '.__('words.error-name'),
        'tm_description.required' => '(TM) '.__('words.error-description'),
        'ru_name.required' => '(RU) '.__('words.error-name'),
        'ru_description.required' => '(RU) '.__('words.error-description'),
        'eng_name.required' => '(ENG) '.__('words.error-name'),
        'eng_description.required' => '(ENG) '.__('words.error-description'),
        'hall.required' => __('words.error-hall'),
        'sort.required' => __('words.error-field'),
        'sort.numeric' => __('words.error-field-number'),
      ]
    );

    $exposure_id = 0;
    if (isset($req->exposure)) {
      $exposure_id = $req->exposure;
    }

    $exhibit = Exhibits::find($exhibitId);
    $exhibit->hall_id = $req->hall;
    $exhibit->exposure_id = $exposure_id;
    $exhibit->tm_name = $req->tm_name;
    $exhibit->ru_name = $req->ru_name;
    $exhibit->eng_name = $req->eng_name;
    $exhibit->tm_description = $req->tm_description;
    $exhibit->ru_description = $req->ru_description;
    $exhibit->eng_description = $req->eng_description;
    if(isset($req->tm_audio)){
      $exhibit->tm_audio = $req->file('tm_audio')->store('public/exhibit-tm-audio');
    }
    if(isset($req->ru_audio)){
      $exhibit->ru_audio = $req->file('ru_audio')->store('public/exhibit-ru-audio');
    }
    if(isset($req->eng_audio)){
      $exhibit->eng_audio = $req->file('eng_audio')->store('public/exhibit-eng-audio');
    }
    if(isset($req->image)){
      $exhibit->image = $req->file('image')->store('public/exhibit-image');
    } else {
      if(isset($req->image_del)){
        $exhibit->image = "";
      }
    }
    $exhibit->sort = $req->sort;
    $exhibit->status = $req->status;
    $exhibit->save();
    return redirect('/'.$lang.'/admin/exhibits');
  }
  public function qrcode(string $lang, int $exposureId, int $exhibitId)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    $exhibit = Exhibits::where('id', $exhibitId)->get();
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }

    App::setlocale($lang);
    return view('admin.exhibit.qr-exhibit', ['lang'=>$lang, 'exhibit'=>$exhibit, 'exposureId'=>$exposureId, 'exhibitId'=>$exhibitId]);
  }
  public function allqrcode(string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    $exhibit = Exhibits::all();
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
      return redirect('/'.$lang.'/admin/tickets');
    }

    App::setlocale($lang);
    return view('admin.exhibit.qr-all-exhibit', ['lang'=>$lang, 'exhibit'=>$exhibit]);
  }

  public function deleteExhibit(Request $req, string $lang, int $length){
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setlocale($lang);
    for ($i=0; $i < $length; $i++) { 
      $exh = "check".$i;
      if(isset($req->$exh)){
        $exhibit = Exhibits::find($req->$exh);
        $exhibit->delete();
      }
    }
    return redirect('/'.$lang.'/admin/exhibits');
  }
}
