<?php
    /*
    |--------------------------------------------------------------------------
    | Crm Routes
    |--------------------------------------------------------------------------
    |
    | Store here only admin panel routes just as roles/users/permissions/setting
    |
    */
    $router->group(['prefix' => 'customers'], function () use ($router) {
        $router->post('/', ['uses' => 'Crm\CustomerController@get']);
        $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\CustomerController@getOne']);
            $router->put('/', ['uses' => 'Crm\CustomerController@updateOne']);
            $router->delete('/', ['uses' => 'Crm\CustomerController@deleteOne']);
            $router->get('tasks', ['uses' => 'Crm\TaskController@tasksCustomer']);
        });
        $router->group(['prefix' => 'groups'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\ManagerController@findGroupCustomers']);
            $router->post('/', ['uses' => 'Crm\GroupController@create']);
            $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
                $router->get('/', ['uses' => 'Crm\GroupController@findOne']);
                $router->put('/', ['uses' => 'Crm\GroupController@updateOne']);
                $router->delete('/', ['uses' => 'Crm\GroupController@deleteOne']);
            });
        });

    });
    $router->post('customers', ['uses' => 'Crm\CustomerController@get']);
    //$router->post('customers', ['uses' => 'Crm\CustomerController@create']);
    $router->group(['prefix' => 'customers/{id:[0-9]+}'], function () use ($router) {
        $router->get('/', ['uses' => 'Crm\CustomerController@getOne']);
        $router->put('/', ['uses' => 'Crm\CustomerController@updateOne']);
        $router->delete('/', ['uses' => 'Crm\CustomerController@deleteOne']);
        $router->get('tasks', ['uses' => 'Crm\TaskController@tasksCustomer']);

    });
    $router->group(['prefix' => 'customers/groups'], function () use ($router) {
        $router->get('/', ['uses' => 'Crm\ManagerController@findGroupCustomers']);
        $router->post('/', ['uses' => 'Crm\GroupController@create']);
        $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\GroupController@findOne']);
            $router->put('/', ['uses' => 'Crm\GroupController@updateOne']);
            $router->delete('/', ['uses' => 'Crm\GroupController@deleteOne']);
        });
    });
