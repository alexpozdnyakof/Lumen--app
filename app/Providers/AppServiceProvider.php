<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

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
    public function boot()
    {
    
      Resource::withoutWrapping();
      setlocale(LC_TIME, 'ru_RU.UTF-8');
      Carbon::setLocale(config('app.locale'));
     }
}
