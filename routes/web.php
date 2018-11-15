<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/




$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('/auth/login', 'AuthController@postLogin');
$router->group(['middleware' => 'auth:api'], function($router)
{
    $router->get('echo', function() {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    });
});

$router->group(['prefix' => 'api'], function () use ($router) {
  $router->get('prospects',  ['uses' => 'ProspectController@showAllProspects']);
  $router->get('prospects/{id}', ['uses' => 'ProspectController@showOneProspect']);
  $router->post('prospects', ['uses' => 'ProspectController@create']);
  $router->delete('prospects/{id}', ['uses' => 'ProspectController@delete']);
  $router->put('prospects/{id}', ['uses' => 'ProspectController@update']);
  $router->get('manager/{id}/prospects', ['uses' => 'ManagersController@searchProspects']);
  $router->get('printInvoice', ['uses' => 'CertificatesController@certificateTemplates']);

  $router->get('email', function ()  {
    return view('mail', ['theme' => 'Перезакрепление']);
});

$router->get('certificate', ['uses' => 'CertificatesController@certificate']);
$router->get('certificates', ['uses' => 'CertificatesController@index']);
$router->post('createdList', ['uses' => 'CertificatesController@certificates']);
$router->post('certificateFiles', ['uses' => 'CertificatesController@getFiles']);
$router->post('certificateSend', ['uses' => 'CertificatesController@certificate']);
$router->post('certificates', ['uses' => 'CertificatesController@createCertificate']);

$router->post('parseTable', ['uses' => 'DatatableController@parseTable']);


$router->get('getPdf', function ()  {
    return view('certificate', ['theme' => 'Сертификаты']);
});
$router->post('getTable', ['uses' => 'DatatableController@index']);
$router->get('ranges', ['uses' => 'DatatableController@getRanges']);
$router->get('loanKeys', ['uses' => 'LoansController@index']);

$router->post('loans/calculate', ['uses' => 'LoansController@calculate']);



//$router->get('test', ['uses' => 'PrinterController@index']);
$router->get('test', ['uses' => 'LoansController@index']);


});


// todo where get controllers

/*
curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4OFwvYXV0aFwvbG9naW4iLCJpYXQiOjE1NDIwMDgzMDgsImV4cCI6MTU0MjAxMTkwOCwibmJmIjoxNTQyMDA4MzA4LCJqdGkiOiJqbEFkSE9rVnF4czc4T0V3Iiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.I9BucnUryaWJXEg2ez6DAhiPXbGL-3tJAeeS2tx6PZQ" http://localhost:8088/authtest
*/