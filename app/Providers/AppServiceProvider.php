<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Statamic\Statamic;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Statamic::script('app', 'cp');
    // Statamic::style('app', 'cp');
    
    // Set global mailto address
    if ($this->app->environment('local') || $this->app->environment('staging'))
    {
      Mail::alwaysTo(env('MAIL_TO'));
    }
  }
}
