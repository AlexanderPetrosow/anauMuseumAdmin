<?php

use App\Providers\MenuServiceProvider;

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use App\Models\Tickets;
use App\Models\Currency;
use App\Models\Tariffs;
use App\Models\TariffPrices;
use App\Models\Users;
use App\Models\Halls;
use App\Models\Exposures;
use App\Models\Exhibits;

$controller_path = 'App\Http\Controllers';

// Redirect
Route::get('/', function(){
    return redirect('/tm');
});

// Auth Guide Page
Route::get('/{lang}/auth/{login?}/{password?}', function($lang, $login = '', $password = ''){
    App::setLocale($lang);
    return view('guide/auth', ['lang'=>$lang, 'login'=>$login, 'password'=>$password]);
})->middleware('demo.guide');
Route::post('/{lang}/auth', $controller_path . '\guide\Auth@auth');

// Main Guide Page
Route::get('/{lang}', function($lang){
    // if (!session()->has('client')) {
    //     return redirect('/'.$lang.'/auth');
    // }
    App::setLocale($lang);
    return view('guide/welcome', ['lang'=>$lang]);
})->middleware('auth.guide');

// Home Guide Page
Route::get('/{lang}/home', function($lang){
    // if (!session()->has('client')) {
    //     return redirect('/'.$lang.'/auth');
    // }
    App::setLocale($lang);
    return view('guide/home', ['lang'=>$lang]);
})->middleware('auth.guide');

// Content Guide Page
Route::get('/{lang}/content/{exposureId}/{exhibitId}', $controller_path . '\guide\Content@index')->middleware('auth.guide');

// ------------------------------------------------------------------------------------------------


// Main Admin Page
// Route::get('/{lang}/admin', $controller_path . '\museum\Dashboard@index')->name('dashboard');
Route::get('/{lang}/admin', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    if(session('group') == 1){
        return redirect('/'.$lang.'/admin/dashboards');
    } elseif (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }
})->middleware('demo');
   
    
// Admin Auth
Route::get('/{lang}/admin/auth', function($lang){
    App::setLocale($lang);
    return view('admin/auth/auth', ['lang'=>$lang]);
})->name('dashboard');
Route::post('/{lang}/admin/auth', $controller_path . '\museum\Dashboard@auth')->name('dashboard');

Route::get('/{lang}/admin/logout', function($lang){
    if(session()->has('user')){
    session()->pull('user');
}
App::setLocale($lang);
return redirect('/'.$lang.'/admin');
});

// Admin Dashboards
Route::get('/{lang}/admin/dashboards', $controller_path . '\museum\Dashboard@index')->middleware('demo')->name('dashboard');
Route::post('/{lang}/admin/dashboards', $controller_path . '\museum\Dashboard@index')->name('dashboard');

// Admin Ticket
Route::get('/{lang}/admin/tickets', function($lang){
      if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
      }
      App::setLocale($lang);
      MenuServiceProvider::boot(session('group'));

    if (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

      Paginator::useBootstrap();
      $tickets = Tickets::orderBy('id','DESC')->paginate(10);
      $tariffs = Tariffs::all();
      $currencies = Currency::all();
      return view('admin.tickets.tickets-list', ['lang'=>$lang, 'tickets'=>$tickets, 'tariffs'=>$tariffs,'currencies'=>$currencies]);
})->middleware('demo')->name('ticket');
Route::post('/{lang}/admin/tickets', $controller_path . '\museum\Ticket@index')->name('ticket');
Route::get('/{lang}/admin/add-ticket', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    if (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }
    $tariffs = Tariffs::where('status', 1)->orderBy('sort','DESC')->get();
    $tariffPrices = TariffPrices::all();
    $currencies = Currency::all();
    App::setLocale($lang);
    return view('admin/tickets/add-ticket', ['lang'=>$lang, 'tariffs'=>$tariffs, 'tariffPrices'=>$tariffPrices, 'currencies'=>$currencies]);
})->middleware('demo')->name('ticket');
Route::post('/{lang}/admin/add-ticket', $controller_path . '\museum\Ticket@addTicket');
Route::get('/{lang}/admin/ticket-gen/{orderId}', $controller_path . '\museum\Ticket@ticketGenerate')->middleware('demo');
Route::post('/{lang}/admin/delete-ticket/{length}', $controller_path . '\museum\Ticket@deleteTicket');

// Admin Tariff
Route::get('/{lang}/admin/tariffs', $controller_path . '\museum\Tariff@index')->middleware('demo')->name('tariff');
Route::get('/{lang}/admin/add-tariff', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    $currency = Currency::all();
    
    App::setLocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

    return view('admin/tariff/add-tariff', ['lang'=>$lang, 'currencies'=>$currency]);
})->middleware('demo')->name('tariff');
Route::post('/{lang}/admin/add-tariff', $controller_path . '\museum\Tariff@addTariff');
Route::get('/{lang}/admin/edit-tariff/{tariffId}', function($lang, $tariffId){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

    $currency = Currency::all();
    $tariff = Tariffs::where('id', $tariffId)->get();
    $tariffPrices = TariffPrices::where('tariff_id', $tariffId)->get();

    App::setLocale($lang);
    MenuServiceProvider::boot(session('group'));
    return view('admin/tariff/edit-tariff', ['lang'=>$lang, 'currencies'=>$currency, 'tariff'=>$tariff, 'tariffPrices'=>$tariffPrices]);
})->middleware('demo')->name('tariff');
Route::post('/{lang}/admin/edit-tariff/{tariffId}', $controller_path . '\museum\Tariff@editTariff')->name('tariff');
Route::post('/{lang}/admin/delete-tariff/{length}', $controller_path . '\museum\Tariff@deleteTariff')->name('tariff');

// Admin Hall
Route::get('/{lang}/admin/halls', $controller_path . '\museum\Hall@index')->name('hall');
Route::get('/{lang}/admin/add-hall', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

    return view('admin/hall/add-hall', ['lang'=>$lang]);
})->name('hall');
Route::post('/{lang}/admin/add-hall', $controller_path . '\museum\Hall@addHall');
Route::get('/{lang}/admin/edit-hall/{hallId}', function($lang, $hallId){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

    $hall = Halls::where('id', $hallId)->get();
    return view('admin/hall/edit-hall', ['lang'=>$lang, 'hall'=>$hall]);
})->name('hall');
Route::post('/{lang}/admin/edit-hall/{hallId}', $controller_path . '\museum\Hall@editHall');
Route::post('/{lang}/admin/delete-hall/{length}', $controller_path . '\museum\Hall@deleteHall');

// Admin Exposure
Route::get('/{lang}/admin/exposures', $controller_path . '\museum\Exposure@index')->name('exposure');
Route::get('/{lang}/admin/add-exposure', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    $halls = Halls::where('status', 1)->get();

    App::setlocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }
    return view('admin.exposure.add-exposure', ['lang'=>$lang, 'halls'=>$halls]);
})->name('exposure');
Route::post('/{lang}/admin/add-exposure', $controller_path . '\museum\Exposure@addExposure');
Route::get('/{lang}/admin/edit-exposure/{exposureId}', function($lang, $exposureId){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    $halls = Halls::where('status', 1)->get();
    $exposure = Exposures::where('id', $exposureId)->get();

    App::setlocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }

    return view('admin.exposure.edit-exposure', ['lang'=>$lang, 'halls'=>$halls, 'exposure'=>$exposure]);
})->name('exposure');
Route::post('/{lang}/admin/edit-exposure/{exposureId}', $controller_path . '\museum\Exposure@editExposure')->name('exposure');
Route::get('/{lang}/admin/qr-exposure/{exposureId}', $controller_path . '\museum\Exposure@qrcode')->name('exposure');
Route::get('/{lang}/admin/qr-all-exposure', $controller_path . '\museum\Exposure@allqrcode')->name('exposure');
Route::post('/{lang}/admin/delete-exposure/{length}', $controller_path . '\museum\Exposure@deleteExposure')->name('exposure');

// Admin Exhibit
Route::get('/{lang}/admin/exhibits', $controller_path . '\museum\Exhibit@index')->name('exhibit');
Route::get('/{lang}/admin/add-exhibit', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    $halls = Halls::where('status', 1)->get();
    $exposures = Exposures::where('status', 1)->get();

    App::setlocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }

    return view('admin.exhibit.add-exhibit', ['lang'=>$lang, 'halls'=>$halls, 'exposures'=>$exposures]);
})->name('exhibit');
Route::post('/{lang}/admin/add-exhibit', $controller_path . '\museum\Exhibit@addExhibit');
Route::get('/{lang}/admin/edit-exhibit/{exhibitId}', function($lang, $exhibitId){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    $halls = Halls::where('status', 1)->get();
    $exposures = Exposures::where('status', 1)->get();
    $exhibit  = Exhibits::where('id', $exhibitId)->get();

    App::setlocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }

    return view('admin.exhibit.edit-exhibit', ['lang'=>$lang, 'halls'=>$halls, 'exposures'=>$exposures, 'exhibit'=>$exhibit]);
})->name('exhibit');
Route::post('/{lang}/admin/edit-exhibit/{exhibitId}', $controller_path . '\museum\Exhibit@editExhibit')->name('exhibit');
Route::get('/{lang}/admin/qr-exhibit/{exposureId}/{exhibitId}', $controller_path . '\museum\Exhibit@qrcode')->name('exhibit');
Route::get('/{lang}/admin/qr-all-exhibit', $controller_path . '\museum\Exhibit@allqrcode')->name('exhibit');
Route::post('/{lang}/admin/delete-exhibit/{length}', $controller_path . '\museum\Exhibit@deleteExhibit')->name('exhibit');

// Admin Users
Route::get('/{lang}/admin/users', $controller_path . '\museum\User@index')->middleware('demo')->name('user');
Route::get('/{lang}/admin/add-user', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }

    return view('admin/users/add-user',['lang'=>$lang]);
})->middleware('demo')->name('user');
Route::post('/{lang}/admin/add-user', $controller_path . '\museum\User@addUser');
Route::get('/{lang}/admin/edit-user/{userId}', function($lang, $userId){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
      }
      App::setLocale($lang);
      MenuServiceProvider::boot(session('group'));

    if (session('group') == 2) {
        return redirect('/'.$lang.'/admin/tickets');
    }  elseif (session('group') == 3) {
        return redirect('/'.$lang.'/admin/exposures');
    }
      $user = Users::where('id', $userId)->get();
      return view('admin.users.edit-user', ['lang'=>$lang, 'user'=>$user]);
})->middleware('demo')->name('user');
Route::post('/{lang}/admin/edit-user/{userId}', $controller_path . '\museum\User@editUser');
Route::post('/{lang}/admin/delete-user/{length}', $controller_path . '\museum\User@deleteUser');

// Admin Additionally
Route::get('/{lang}/admin/support', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    MenuServiceProvider::boot(session('group'));
    return view('admin/additionally/support',['lang'=>$lang]);
})->name('support');

Route::get('/{lang}/admin/documentation', function($lang){
    if (!session()->has('user')) {
        return redirect('/'.$lang.'/admin/auth');
    }
    App::setLocale($lang);
    MenuServiceProvider::boot(session('group'));
    return view('admin/additionally/documentation',['lang'=>$lang]);
})->middleware('demo')->name('documentation');

// License
Route::post('/{lang}/admin/license', $controller_path . '\museum\Dashboard@license');

// Scanner
Route::get('/{lang}/scanner', function($lang){
    return view('guide.scanner', ['lang'=>$lang]);
});