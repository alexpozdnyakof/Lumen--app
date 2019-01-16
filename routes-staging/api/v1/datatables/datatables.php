<?php
    /*
    |--------------------------------------------------------------------------
    | Datatables Routes
    |--------------------------------------------------------------------------
    |
    | Here routes for datatables module
    |
    */

	$router->post('getTable', ['uses' => 'Datatables\DatatableController@index']);