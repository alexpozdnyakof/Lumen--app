<?php
    /*
    |--------------------------------------------------------------------------
    | Crm Routes
    |--------------------------------------------------------------------------
    |
    | Store here only customer routes
    |
    */

    // show one customer
    // show one customer tasks
    // show one customer okved
    // show one customer analytics
    // create  one customer
    // add task for customer

    // get all my groups
    // get all my active groups
    // get all my inactive groups
    // get one group as list
    // -- sort users in list behind complete tasks
    // -- get active customers from group
    // -- get inactive customers from group
    // -- filter customers in group ?!

    $router->group(['prefix' => 'workspace'], function () use ($router) {
        // ----------- workspace portfolio  ------------//
        $router->get('/portfolio', ['uses' => 'Crm\Workspace\PortfolioController@index']); // [+] get manager portfolio
        // ----------- workspace customers groups  ------------//
        $router->group(['prefix' => 'groups'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\Workspace\GroupController@index']); // [+] get manager groups list params for sort active/inactive/ all buy default
            $router->get('{id:[0-9]+}', ['uses' => 'Crm\Workspace\GroupController@show']); // [+] get one group info
        });
        $router->group(['prefix' => 'egroups'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\Workspace\EgroupController@index']);
            $router->get('{id:[0-9]+}', ['uses' => 'Crm\Workspace\EgroupController@show']);
        });

        // ----------- workspace customers ------------//
        $router->group(['prefix' => 'customers'], function () use ($router) {
            $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
                $router->get('/', ['uses' => 'Crm\Workspace\CustomerController@index']); // [+] show customer main info
                $router->get('/tasks', ['uses' => 'Crm\Workspace\TaskController@customer']); // [+] show customer tasks by user
                $router->get('/managers', ['uses' => 'Crm\Workspace\ManagerController@customer']); // [-] show customer managers
                $router->get('/analytics', ['uses' => 'Crm\Workspace\CustomerController@analytics']); // [+] show customer analytics
                $router->get('/okved', ['uses' => 'Crm\Workspace\CustomerController@okvedCodes']); // [-] show customer okved
                $router->put('/', ['uses' => 'Crm\Workspace\CustomerController@update']); // [-] update customer data
            });
            $router->group(['prefix' => 'group'], function () use ($router) {
                $router->get('{id:[0-9]+}', ['uses' => 'Crm\Workspace\GroupController@customers']); // [-] show customer in one group
            });
        });
        // ----------- workspace tasks ------------//
        $router->group(['prefix' => 'tasks'], function () use ($router) {
            $router->get('/', ['uses' => 'Crm\Workspace\TaskController@index']); // [+] show my tasks params for sort active/inactive/ all buy default
            $router->post('/', ['uses' => 'Crm\Workspace\TaskController@store']); // [+] create task create one or multiple // move it to task controller
            $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
                $router->get('/', ['uses' => 'Crm\Workspace\TaskController@show']); // [+]  move to parent and create resource
                $router->put('/', ['uses' => 'Crm\Workspace\TaskController@update']); // [-] update task
                $router->delete('/', ['uses' => 'Crm\Workspace\TaskController@destroy']); // [-] destroy task
            });
        });
    });