<?php
    /*
    |--------------------------------------------------------------------------
    | MadeByTim Routes
    |--------------------------------------------------------------------------
    |
    | Here routes created by Tim
    |
    */

    $router->get('/stats/loans_managers', ['uses'=>'StatsController@loansManagers']);
    $router->get('/stats/loans_bank', ['uses'=>'StatsController@loansBank']);
    $router->get('/stats/accounts_managers', ['uses'=>'StatsController@AccountsManagers']);
    $router->get('/stats/accounts_bank', ['uses'=>'StatsController@AccountsBank']);