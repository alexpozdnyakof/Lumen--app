<?php
    /*
    |--------------------------------------------------------------------------
    | Crm Routes
    |--------------------------------------------------------------------------
    |
    | Store here only task routes
    |
    */

    // show all tasks group by status
    // show one task
    // create one task
    // create many tasks

    $router->get('tasks', ['uses' => 'Crm\TaskController@tasksUser']);
    //$router->post('customers', ['uses' => 'Crm\CustomerController@create']);
    $router->get('tasksDev', ['uses' => 'Crm\TaskController@tasksdev']);
    $router->group(['prefix' => 'tasks/{id:[0-9]+}'], function () use ($router) {
        $router->get('/', ['uses' => 'Crm\TaskController@index']);
    });

