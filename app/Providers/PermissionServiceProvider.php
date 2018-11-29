<?php

namespace App\Providers;
use App\Models\User\Permission;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Resources\Json\Resource;

class PermissionServiceProvider extends ServiceProvider
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
        Permission::get()->map(function($permission){
			Gate::define($permission->slug, function($user) use ($permission){
				return $user->hasPermissionTo($permission);
			});
        });
        Blade::directive('role', function ($role){
			return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
	    });
	    Blade::directive('endrole', function ($role){
		    return "<?php endif; ?>";
	    });

     }

}