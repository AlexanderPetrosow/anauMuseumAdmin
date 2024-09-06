<?php

namespace App\Http\Controllers\guide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tickets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class Auth extends Controller
{
  public function auth(Request $req, string $lang)
  {
    $login = $req->login;
    $pass = $req->password;
    $tickets = Tickets::all();
    App::setLocale($lang);

    $validator = \Validator::make(request()->all(), 
      [
        'login' => 'required | min:3',
        'password' => 'required | min:8'
      ],
      [
        'login.required' => 'Заполните это поля',
        'login.min' => 'Минимальное количество значений: 3',
        'password.required' => 'Заполните это поля',
        'password.min' => 'Минимальное количество значений: 8',
      ]
    );

    foreach ($tickets as $ticket) {
      if($login == $ticket['login'] && $pass == $ticket['password']){
        if($ticket['status'] != 0){
          $req->session()->put('client', $ticket['id']);
          $tickets = Tickets::find($ticket['id']);
          $tickets->status = 0;
          $tickets->save();
          return redirect('/'.$lang);
        } else {
          $validator->after(function ($validator) {
            if (request('auth') == null) {
                $validator->errors()->add('auth', 'Ваш билет уже активирован');
            }
          });      
        }
        
      }
    }

    $validator->after(function ($validator) {
      if (request('auth') == null) {
          $validator->errors()->add('auth', 'Не правильный логин или пароль');
      }
    });
    
  $validator->validate();

  }  
}
