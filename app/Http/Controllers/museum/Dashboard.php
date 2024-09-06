<?php

namespace App\Http\Controllers\museum;

use App\Providers\MenuServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Tariffs;
use App\Models\Halls;
use App\Models\Exhibits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class Dashboard extends Controller
{
  public function index(Request $req, string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }
    MenuServiceProvider::boot(session('group'));
    App::setLocale($lang);

    // Отчет по продажам по выбранной дате
    $all_sale_name = array();   
    if(!isset($req->date_submit) || !isset($req->start_date) || !isset($req->end_date)){
      $all_sale = DB::table('museum_db.tickets')
               ->select(DB::raw('tariff_id, count(tariff_id) as count'))
               ->whereMonth('created_at', date("m"))
               ->whereYear('created_at', date("Y"))
              //  ->whereYear('created_at', "2024")
               ->groupBy('tariff_id')
               ->orderBy('count', 'DESC')
               ->limit(6)
               ->get();
    } else {
      $all_sale = DB::table('museum_db.tickets')
               ->select(DB::raw('tariff_id, count(tariff_id) as count'))
               ->whereDate('created_at', '>=', $req->start_date)
               ->whereDate('created_at', '<=', $req->end_date)
               ->groupBy('tariff_id')
               ->orderBy('count', 'DESC')
               ->limit(6)
               ->get();  
    }

    for ($i=0; $i < count($all_sale); $i++) { 
        $tariffs = Tariffs::where('id',$all_sale[$i]->tariff_id)->get();
        if(isset($tariffs[0]['id'])){
          array_push($all_sale_name, $tariffs[0][$lang.'_name']);
        } else {
          array_push($all_sale_name, __('words.empty'));
        }
    }
    // -
    
    // Рейтинг просмотра залов за год
    $hall_year_name = array();
    $hall_year = DB::table('museum_db.statistics')
             ->select(DB::raw('hall_id, count(hall_id) as hall, YEAR(`created_at`) as datas'))
             ->whereYear('created_at', date("Y"))
            //  ->whereYear('created_at', "2024")
             ->groupBy('datas')
             ->groupBy('hall_id')
             ->orderBy('hall', 'DESC')
             ->limit(6)
             ->get();

    for ($i=0; $i < count($hall_year); $i++) { 
        $halls = Halls::where('id',$hall_year[$i]->hall_id)->get();
        if(isset($halls[0]['id'])){
          array_push($hall_year_name, $halls[0][$lang.'_name']);
        } else {
          array_push($hall_year_name, __('words.empty'));
        }
    }
    // -

    // Рейтинг просмотра экспонатов за год
    $exhibit_year_name = array();
    $exhibit_year = DB::table('museum_db.statistics')
             ->select(DB::raw('exhibit_id, count(exhibit_id) as exhibit, YEAR(`created_at`) as datas'))
             ->whereYear('created_at', date("Y"))
            //  ->whereYear('created_at', "2024")
             ->groupBy('datas')
             ->groupBy('exhibit_id')
             ->orderBy('exhibit', 'DESC')
             ->limit(6)
             ->get();

    for ($i=0; $i < count($exhibit_year); $i++) { 
      if($exhibit_year[$i]->exhibit_id != "0"){
        $exhibits = Exhibits::where('id',$exhibit_year[$i]->exhibit_id)->get();
        if(isset($exhibits[0]['id'])){
          array_push($exhibit_year_name, $exhibits[0][$lang.'_name']);
        } else {
          array_push($exhibit_year_name, __('words.empty'));
        }
      } else {
        array_push($exhibit_year_name, __('words.empty'));
      }
    }
    // -

    // Статистика дневного посещения музея по часам за год
    $visit_hours_year = DB::table('museum_db.tickets')
             ->select(DB::raw('HOUR(created_at) as hour, count(id) as count, YEAR(created_at) as year'))
             ->whereYear('created_at', date("Y"))
            //  ->whereYear('created_at', "2024")
             ->groupBy('hour')
             ->groupBy('year')
             ->orderBy('count', 'DESC')
             ->get();
    // -

    // Отчет по продажам по дням недели за год
    $week_sale_year = DB::table('museum_db.tickets')
             ->select(DB::raw('count(id) as count, weekday(created_at) as weeks, year(created_at) as year'))
             ->whereYear('created_at', date("Y"))
            //  ->whereYear('created_at', "2024")
             ->groupBy('weeks')
             ->groupBy('year')
             ->orderBy('weeks', 'ASC')
             ->get();
    // -
    
    // Отчет по продажам категорий билетов за текущий месяц
    $month_sale_name = array();
    $month_sale = DB::table('museum_db.tickets')
             ->select(DB::raw('month(created_at) as month, tariff_id, count(tariff_id) as count'))
             ->whereMonth('created_at', date("m"))
             ->whereYear('created_at', date("Y"))
            //  ->whereYear('created_at', "2024")
             ->groupBy('month')
             ->groupBy('tariff_id')
             ->orderBy('count', 'DESC')
             ->limit(6)
             ->get();

    for ($i=0; $i < count($month_sale); $i++) { 
        $tariffs = Tariffs::where('id',$month_sale[$i]->tariff_id)->get();
        if(isset($tariffs[0]['id'])){
          array_push($month_sale_name, $tariffs[0][$lang.'_name']);
        } else {
          array_push($month_sale_name, __('words.empty'));
        }
    }
    // -

    // Отчет по продажам категорий билетов за текущий год
    $year_sale_name = array();
    $year_sale = DB::table('museum_db.tickets')
             ->select(DB::raw('year(created_at) as year, tariff_id, count(tariff_id) as count'))
             ->whereYear('created_at', date("Y"))
            //  ->whereYear('created_at', "2024")
             ->groupBy('year')
             ->groupBy('tariff_id')
             ->orderBy('count', 'DESC')
             ->limit(6)
             ->get();

    for ($i=0; $i < count($year_sale); $i++) { 
        $tariffs = Tariffs::where('id',$year_sale[$i]->tariff_id)->get();
        if(isset($tariffs[0]['id'])){
          array_push($year_sale_name, $tariffs[0][$lang.'_name']);
        } else {
          array_push($year_sale_name, __('words.empty'));
        }
    }
    // -

    // Отчет по продажам кассиров за текущий месяц
    $kassir_sale_name = array();
    $kassir_sale = DB::table('museum_db.tickets as tickets')
             ->join('museum_db.users as users', 'tickets.user_id', '=', 'users.id')
             ->select(DB::raw('tickets.user_id as tUser, count(tickets.user_id) as count, month(tickets.created_at) as month, users.name as kassir_name, users.group as uGroup'))
             ->whereMonth('tickets.created_at', date("m"))
             ->whereYear('tickets.created_at', date("Y"))
            //  ->whereYear('tickets.created_at', "2024")
             ->where('users.group', 2)
             ->groupBy('month')
             ->groupBy('tickets.user_id')
             ->orderBy('count', 'DESC')
             ->get();
    // -

    return view('admin.dashboard.dashboards', [
      'lang'=>$lang,
      'all_sale'=>$all_sale, 
      'all_sale_name'=>$all_sale_name, 
      'hall_year'=>$hall_year, 
      'hall_year_name'=>$hall_year_name, 
      'exhibit_year'=>$exhibit_year, 
      'exhibit_year_name'=>$exhibit_year_name, 
      'visit_hours_year'=>$visit_hours_year, 
      'week_sale_year'=>$week_sale_year, 
      'month_sale'=>$month_sale, 
      'month_sale_name'=>$month_sale_name,
      'year_sale'=>$year_sale, 
      'year_sale_name'=>$year_sale_name,
      'kassir_sale'=>$kassir_sale, 
      'kassir_sale_name'=>$kassir_sale_name,
    ]);
    
  }

  public function auth(Request $req, string $lang)
  {
    $login = $req->login;
    $pass = $req->password;
    $lang = $req->langs;
    $users = Users::all();
    App::setLocale($lang);

    $validator = \Validator::make(request()->all(), 
      [
        'login' => 'required | min:3',
        'password' => 'required | min:8'
      ],
      [
        'login.required' => __('words.error-field'),
        'login.min' => __('words.error-min-size').' 3',
        'password.required' => __('words.error-field'),
        'password.min' => __('words.error-min-size').' 8',
      ]
    );

    foreach ($users as $user) {
      if($login == $user['login'] && Hash::check($pass, $user['password'])){
        if($user['status'] == 1){
          $req->session()->put('user', $user['id']);
          $req->session()->put('name', $user['name']);
          $req->session()->put('group', $user['group']);
          return redirect('/'.$lang.'/admin');
        }
      }
    }

    $validator->after(function ($validator) {
      if (request('auth') == null) {
          $validator->errors()->add('auth', __('words.error-auth'));
      }
  
  });
  $validator->validate();

  }  

  public function license(Request $req, string $lang){
    App::setLocale($lang);
    file_put_contents(base_path('license'), $req->code, LOCK_EX);
    $arr = array();
    if(Hash::check(file_get_contents(base_path('license')), file_get_contents(base_path('.igitignore')))){
      $arr = ['type'=>'success', 'msg'=>__('words.activ_scs_msg')];
    } else {
      $arr = ['type'=>'danger', 'msg'=>__('words.activ_err_msg')];
    }
    return redirect()->back()->with('licenseMsg', $arr);
  }
}
