<?php 
	/*
    |--------------------------------------------------------------------------
    | Application routing endpoint
	|--------------------------------------------------------------------------
	*/

	$router->get('/', function () use ($router) {
		return $router->app->version();
	});

	include_once 'api/v1/common/auth.php';
	include_once 'api/v1/common/common.php';
	include_once 'api/v1/products/tv.php';
	include_once 'api/v1/schedules/schedules.php';

	$router->group(['prefix' => 'api'], function () use ($router) {
		$router->group(['middleware' => 'auth:api'], function($router){
			$router->get('/user/current',  ['uses' => 'Permissions\UserController@currentUser']);
	   });
		/*---amulex routes---------------------------------------*/
		include_once 'api/v1/products/amulex.php';

		/*---datatable routes---------------------------------------*/
		include_once 'api/v1/datatables/datatables.php';
		/*---admin routes---------------------------------------*/
		$router->group(['prefix' => 'admin'], function () use ($router) {
			include_once 'api/v1/admin/admin.php';
		});
		/*---crm routes---------------------------------------*/
		$router->group(['prefix' => 'crm'], function () use ($router) {
			include_once 'api/v1/crm/customers.php';
			include_once 'api/v1/crm/managers.php';
			include_once 'api/v1/crm/tasks.php';
		});
		/*---loans routes---------------------------------------*/
		$router->group(['prefix' => 'loans'], function () use ($router) {
			/*---loans calculator routes---------------------------------------*/
			include_once 'api/v1/loans/calculator.php';
		});
	});

