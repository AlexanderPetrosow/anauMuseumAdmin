<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public static function boot($group = 1)
  {
    $license = file_get_contents(base_path('license'));
    if(Hash::check(trim($license), file_get_contents(base_path('.igitignore')))){
      if($group == 1){
        $verticalMenuJson = file_get_contents(base_path('resources/menu/adminMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
      } elseif ($group == 2) {
        $verticalMenuJson = file_get_contents(base_path('resources/menu/kassirMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
      } elseif ($group == 3) {
        $verticalMenuJson = file_get_contents(base_path('resources/menu/contentMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);
      }
    } else {
      $verticalMenuJson = file_get_contents(base_path('resources/menu/demoMenu.json'));
      // $verticalMenuJson = file_get_contents(base_path('resources/menu/adminMenu.json'));
      $verticalMenuData = json_decode($verticalMenuJson);
    }
    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData]);
  }
}
