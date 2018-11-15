<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);
//class_alias(\Barryvdh\Debugbar\Facade::class, 'Debugbar');

  $app->withFacades();

 $app->withEloquent();
 $app->configure('app');
/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);
$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
   // 'jwt' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
 ]);

$app->middleware([
    App\Http\Middleware\CorsMiddleware::class
 ]);
//$app->configure('debugbar');
$app->configure('dompdf');
$app->configure('auth');

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/
$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(Krlove\EloquentModelGenerator\Provider\GeneratorServiceProvider::class);
$app->register(Mnabialek\LaravelSqlLogger\Providers\ServiceProvider::class);
$app->register(Maatwebsite\Excel\ExcelServiceProvider::class);
$app->register(Intervention\Image\ImageServiceProvider::class);
$app->register(\Barryvdh\DomPDF\ServiceProvider::class);
$app->register(Jenssegers\Date\DateServiceProvider::class);
$app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);



//$app->alias('PDF',Barryvdh\DomPDF\Facade);
//$app->register(Illuminate\Mail\MailServiceProvider::class);

//$app->alias('Excel',' Maatwebsite\Excel\Facades\Excel');
//$app->register(Barryvdh\Debugbar\ServiceProvider::class);
//$app->register(Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

/*

|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
