<?php

namespace App\Http\Controllers\museum;

use App\Providers\MenuServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Orders;
use App\Models\Tickets;
use App\Models\Tariffs;
use App\Models\Currency;
use App\Models\Users;


class Ticket extends Controller
{

  public function index(Request $req, string $lang)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    $orderId = $req->orderId;
    $dates = $req->dates;
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 3) {
      return redirect('/'.$lang.'/admin/exposures');
    }

    App::setLocale($lang);
    Paginator::useBootstrap();
    if($orderId != ""){
      $tickets = Tickets::where('order_id', $orderId)->orderBy('id','DESC')->paginate(10);
    } elseif ($dates != "") {
      $tickets = Tickets::whereDate('created_at', $dates)->orderBy('id','DESC')->paginate(10);
    } elseif ($orderId != "" && $dates != "") {
      $tickets = Tickets::where('order_id', $orderId)->whereDate('created_at', $dates)->orderBy('id','DESC')->paginate(10);
    } else {
      $tickets = Tickets::orderBy('id','DESC')->paginate(10);
    }
    // $tickets = [];
    $tariffs = Tariffs::all();
    $currencies = Currency::all();

    return view('admin.tickets.tickets-list', ['lang'=>$lang, 'tickets'=>$tickets, 'tariffs'=>$tariffs,'currencies'=>$currencies, 'orderId'=>$orderId, 'dates'=>$dates]);
  }

  public function addTicket(string $lang, Request $req)
  {
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }

    function generate($length = 6)
    {
      $strings = '';
      $arr = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
      );
    
      for ($i = 0; $i < $length; $i++) {
        $strings .= $arr[random_int(0, count($arr) - 1)];
      }
      return $strings;
    }

    App::setLocale($lang);
    $order = new Orders;
    $order->count = $req->count;
    $order->total_tmt = $req->total_tmt;
    $order->total_usd = $req->total_usd;
    $order->total_euro = $req->total_euro;
    $order->save();
    $orderId = $order->id;
    
    $tickets = $req->tickets;
    $ids = array();
    $ids = explode(',', $tickets[0]);
    for ($i=0; $i < count($ids); $i++) {
      $t = "tariffId_".$ids[$i];
      $c = "currencyId_".$ids[$i];
      $p = "prices_".$ids[$i];
      $count = "count_".$ids[$i];
      

      // $login = Hash::make(generate(8));
      // $password = Hash::make(generate(8));

      if(isset($req->$t)){
        for($b=0; $b < $req->$count; $b++){
          $ticket = new Tickets;
          $ticket->order_id = $orderId;
          $ticket->user_id = session('user');
          $ticket->tariff_id = $req->$t;
          $ticket->currency_id = $req->$c;
          $ticket->price = $req->$p;
          $ticket->pay_type = 1;
          $ticket->login = generate(8);
          $ticket->password = generate(8);
          $ticket->status = 1;
          $ticket->save();
        }
      }
    }
    return redirect('/'.$lang.'/admin/ticket-gen/'.$orderId);
  }

  public function ticketGenerate(string $lang, string $orderId){
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    MenuServiceProvider::boot(session('group'));

    if (session('group') == 3) {
      return redirect('/'.$lang.'/admin/exposures');
    }

    App::setLocale($lang);

    $today = date("d.m.Y");
    $tickets = Tickets::where('order_id', $orderId)->get();
    $tariffs = Tariffs::all();
    $currencies = Currency::all();
    $users = Users::all();

    return view('admin.tickets.generate', [
      'lang'=>$lang, 
      'orderId'=>$orderId,
      'today'=>$today,
      'tickets'=>$tickets,
      'tariffs'=>$tariffs,
      'currencies'=>$currencies,
      'users'=>$users,
    ]);
  }

  public function deleteTicket(Request $req, string $lang, int $length){
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setlocale($lang);

    for ($i=0; $i < $length; $i++) { 
      $tic = "check".$i;
      if(isset($req->$tic)){
          // echo "Delete - " . $req->$tic . "<br>";
          // return "Deleted";
          $ticket = Tickets::find($req->$tic);
          $ticket->delete();
      }
    }
    return redirect('/'.$lang.'/admin/tickets');
  }
}
