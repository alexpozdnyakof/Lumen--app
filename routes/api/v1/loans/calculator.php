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
        $router->get('/revision', ['uses' => 'Loans\CalculatorController@latestScoreUpdate']);
        $router->post('/save', ['uses' => 'Loans\CalculatorController@saveResult']);
        $router->post('/calculate', ['uses' => 'Loans\CalculatorController@index']);
        $router->get('/historylist/{id:[0-9]+}', ['uses' => 'Loans\CalculatorController@getCalculateHistory']);
        $router->get('/history/{id:[0-9]+}', ['uses' => 'Loans\CalculatorController@getOneCalculateHistory']);
    });