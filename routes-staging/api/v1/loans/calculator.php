<?php
    /*
    |--------------------------------------------------------------------------
    | Loans Calculatr Routes
    |--------------------------------------------------------------------------
    |
    | Here routes for calculator product
    |
    */
    $router->group(['prefix' => 'calculator'], function () use ($router) {
        $router->get('/ranges', ['uses' => 'Loans\CalculatorController@ranges']);
        $router->get('/keys', ['uses' => 'Loans\CalculatorController@keys']);
        $router->post('/calculate', ['uses' => 'Loans\CalculatorController@calculate']);
    });