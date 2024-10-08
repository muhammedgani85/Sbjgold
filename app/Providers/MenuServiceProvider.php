<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $main_menus = Menu::get();

    #$formattedData = $menus = Menu::with('subMenus')->get();

    $menus = Menu::with(['subMenus' => function ($query) {
      $query->where('status', 'Active'); // Add your where condition here if needed
    }])->get();

    // Format the data
    $formattedData = [
      'menu' => $menus->map(function ($menu) {
        $submenu = $menu->subMenus->map(function ($sub) {
          return [
            'url' => $sub->url,
            'name' => $sub->name,
            'slug' => $sub->slug,
          ];
        });

        return [
          'url' => $menu->url,
          'name' => $menu->name,
          'icon' => $menu->icon,
          'slug' => $menu->slug,
          'submenu' => $submenu->isEmpty() ? null : $submenu
        ];
      })
    ];

    $verticalMenuJson = json_encode($formattedData);

    $verticalMenuData = json_decode($verticalMenuJson);
    //dd($verticalMenuData);
    // Share all menuData to all the views
    \View::share('menuData', [$verticalMenuData]);
  }
}
