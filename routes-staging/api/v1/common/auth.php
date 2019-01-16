<?php
    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    |
    | Here routes for auth actions
    |
    */
    $router->get('auth/login', 'Common\AuthController@simulatedLogin');
