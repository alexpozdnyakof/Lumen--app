<?php
    /*
    |--------------------------------------------------------------------------
    | Crm Routes
    |--------------------------------------------------------------------------
    |
    | Store here only customer routes
    |
    */
    // auth
    // show prospects
    // -- filter prospects
    // show user tasks
    // show tasks on prospect
    // create task
    // complete task


        // ----------- openApi login  ------------//
        $router->get('/auth/login', ['uses' => 'Common\AuthController@login']); //login
        // ----------- openApi customers  ------------//
        $router->group(['prefix' => 'customers'], function () use ($router) {
            $router->get('/', ['uses' => 'Open\CustomerController@index']);  // [-] get customers -- search customers //maybe set fields what need to show

            $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
                $router->get('/', ['uses' => 'Open\CustomerController@show']); // [-] show one customer
                $router->get('/tasks', ['uses' => 'Open\TaskController@customer']); // [-] show one customer tasks
            });
        });
        // ----------- openApi tasks  ------------//
        $router->group(['prefix' => 'tasks'], function () use ($router) {
            $router->get('/', ['uses' => 'Open\TaskController@index']); // [-] show my tasks
            $router->post('/', ['uses' => 'Open\TaskController@store']); // [-] create task
            $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
                $router->get('/', ['uses' => 'Open\TaskController@show']); // [-] show one task
                $router->put('/', ['uses' => 'Open\TaskController@update']); // [-] update task
            });
        });

