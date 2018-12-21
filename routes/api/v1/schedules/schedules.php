<?php
    /*
    |--------------------------------------------------------------------------
    | Schedules Routes
    |--------------------------------------------------------------------------
    |
    | Here routes to run schedules
    |
    */
    $router->get('/cron/fired', ['uses'=>'FireManagerController@index']);