<?php
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | Store here only admin panel routes just as roles/users/permissions/setting
    |
    */
    // permissions methods TODO: update / delete
    $router->get('permissions', ['uses' => 'Permissions\PermissionController@index']);
    $router->get('permission/{id}', ['uses' => 'Permissions\PermissionController@findOne']);
    $router->post('permission', ['uses' => 'Permissions\PermissionController@create']);
    // roles methods TODO: update / delete
    $router->get('roles', ['uses' => 'Permissions\RoleController@index']);
    $router->get('role/{id}', ['uses' => 'Permissions\RoleController@findOne']);
    $router->post('role', ['uses' => 'Permissions\RoleController@create']);
    // users methods TODO: update / delete
    $router->get('users', ['middleware' => 'role:admin,managers/edit', 'uses' => 'Permissions\UserController@index']);
    $router->get('user/{id}', ['uses' => 'Permissions\UserController@findOne']);
    $router->post('user', ['uses' => 'Permissions\UserController@create']);