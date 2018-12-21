<?php
    /*
    |--------------------------------------------------------------------------
    | MadeByTim Routes
    |--------------------------------------------------------------------------
    |
    | Here routes created by Tim
    |
    */

    $router->get('/stats/loans_managers', ['uses'=>'Products\StatsController@loansManagers']);
    $router->get('/stats/loans_bank', ['uses'=>'Products\StatsController@loansBank']);
    $router->get('/stats/accounts_managers', ['uses'=>'Products\StatsController@AccountsManagers']);
    $router->get('/stats/accounts_bank', ['uses'=>'Products\StatsController@AccountsBank']);