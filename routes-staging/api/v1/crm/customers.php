<?php
    /*
    |--------------------------------------------------------------------------
    | Crm Routes
    |--------------------------------------------------------------------------
    |
    | Store here only admin panel routes just as roles/users/permissions/setting
    |
    */
    $router->get('customers', ['uses' => 'Crm\CustomerController@index']);
    $router->post('customers', ['uses' => 'Crm\CustomerController@create']);
    $router->group(['prefix' => 'customers/{id:[0-9]+}'], function () use ($router) {
        $router->get('/', ['uses' => 'Crm\CustomerController@findOne']);
        $router->put('/', ['uses' => 'Crm\CustomerController@updateOne']);
        $router->delete('/', ['uses' => 'Crm\CustomerController@deleteOne']);
    });
    $router->group(['prefix' => 'customers/groups'], function () use ($router) {
        $router->get('/', ['uses' => 'Crm\GroupController@index']);
        $router->post('/', ['uses' => 'Crm\GroupController@create']);
        $router->group(['prefix' => 'customers/groups/{id:[0-9]+}'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\GroupController@findOne']);
            $router->put('/', ['uses' => 'Crm\GroupController@updateOne']);
            $router->delete('/', ['uses' => 'Crm\GroupController@deleteOne']);
        });
    });
