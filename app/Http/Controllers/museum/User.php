<?php

namespace App\Http\Controllers\museum;

use App\Providers\MenuServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Tickets;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;

class User extends Controller
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
    $userList = Users::orderBy('updated_at','DESC')->paginate(10);
    return view('admin.users.user-list', ['users'=>$userList, 'lang'=>$lang]);
  }

  public function addUser(Request $req, string $lang)
  {
    $req->validate(
      [
        'login' => 'required | min:3',
        'name' => 'required',
        'password' => 'required | min:8',
      ],
      [
        'login.required' => __('words.error-field'),
        'login.min' => __('words.error-min-size').' 3',
        'name.required' => __('words.error-field'),
        'password.required' => __('words.error-field'),
        'password.min' => __('words.error-min-size').' 8',
      ]
    );
    App::setLocale($lang);
      $user = new Users;
      $user->login = $req->login;
      $user->name = $req->name;
      
      // Password hass
      $pass = $req->password;
      $password = Hash::make($pass, [
        'rounds' => 15,
      ]);
      
      $user->password = $password;
      $user->group = $req->group;
      $user->status = $req->status;
      $user->save();
      return redirect('/'.$lang.'/admin/users');
  }
  
  public function editUser(Request $req, string $lang, string $userId)
  {
    $req->validate(
      [
        'login' => 'required | min:3',
        'name' => 'required',
        // 'password' => 'required | min:8',
      ],
      [
        'login.required' => __('words.error-field'),
        'login.min' => __('words.error-min-size').' 3',
        'name.required' => __('words.error-field'),
        // 'password.required' => 'Заполните это поля',
        // 'password.min' => 'Минимальное количество значений: 8',
      ]
    );
    App::setLocale($lang);
      $user = Users::find($userId);
      $user->login = $req->login;
      $user->name = $req->name;
      
      // Password check
      if(isset($req->password)){
        $pass = $req->password;
        // Password hass
        $password = Hash::make($pass, [
          'rounds' => 15,
        ]);
        
        $user->password = $password;
      }
      $user->group = $req->group;
      $user->status = $req->status;
      $user->save();
      return redirect('/'.$lang.'/admin/users');
  }
  public function deleteUser(Request $req, string $lang, int $length){
    if (!session()->has('user')) {
      return redirect('/'.$lang.'/admin/auth');
    }
    App::setlocale($lang);

    $validator = \Validator::make(request()->all(),[]);

    for ($i=0; $i < $length; $i++) { 
      $us = "check".$i;
      if(isset($req->$us)){
        $ticket = Tickets::where('user_id', $req->$us)->get();
        if(!isset($ticket[0]['id'])){
          $user = Users::find($req->$us);
          $user->delete();
        } else {
          $validator->after(function ($validator) {
            $validator->errors()->add('deleted', 'Нельзя удалить пользователя (У пользователя есть активные записи)');
          });
          $validator->validate();
        }
      }
    }
    return redirect('/'.$lang.'/admin/users');
  }
}
