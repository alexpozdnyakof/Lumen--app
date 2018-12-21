<?php
    /*
    |--------------------------------------------------------------------------
    | Crm Routes
    |--------------------------------------------------------------------------
    |
    | Store here only crm routes routes just as lists/clients/prospects/activity etc.
    |
    */

    $router->get('managers', ['uses' => 'Crm\ManagerController@index']);
    $router->post('managers', ['uses' => 'Crm\ManagerController@create']);

    $router->group(['prefix' => 'managers/'], function () use ($router) {
        $router->post('/portfolio', ['uses' => 'Crm\ManagerController@portfolio']);
        $router->group(['prefix' => 'groups'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\ManagerController@groups']);
            $router->post('/{group:[0-9]+}', ['uses' => 'Crm\ManagerController@customersInGroup']);
        });
    });
    $router->group(['prefix' => 'managers/{id:[0-9]+}'], function () use ($router) {
        $router->get('/', ['uses' => 'Crm\ManagerController@findOne']);
        $router->put('/', ['uses' => 'Crm\ManagerController@updateOne']);
        $router->delete('/', ['uses' => 'Crm\ManagerController@deleteOne']);
        $router->group(['prefix' => 'groups'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\ManagerController@findGroups']);
        });
    });
