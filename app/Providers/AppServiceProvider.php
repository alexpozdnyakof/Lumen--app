<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

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

      Builder::macro('whereLike', function ($attributes, string $searchTerm) {
        $this->where(function (Builder $query) use ($attributes, $searchTerm) {
            foreach (array_wrap($attributes) as $attribute) {
                $query->when(
                    str_contains($attribute, '.'),
                    function (Builder $query) use ($attribute, $searchTerm) {
                        [$relationName, $relationAttribute] = explode('.', $attribute);

                        $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                            $query->whereRaw('LOWER('.$relationAttribute.') like ?', ["%{$searchTerm}%"]);
                        });
                    },
                    function (Builder $query) use ($attribute, $searchTerm) {
                        $query->orWhereRaw('LOWER('.$attribute.') like ?', ["%{$searchTerm}%"]);
                    }
                );
            }
        });
        return $this;
    });
     }
}
