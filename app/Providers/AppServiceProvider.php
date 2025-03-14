<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->singleton(SomeServiceInterface::class, function ($app) {
      return new SomeService();
  });
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    if ($this->app->environment('production')) {
      \URL::forceScheme('https');
  }

  // Set default pagination to use Bootstrap (or Tailwind)
  Paginator::useBootstrap();
  }

}
