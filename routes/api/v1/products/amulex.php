<?php
    /*
    |--------------------------------------------------------------------------
    | Amulex Routes
    |--------------------------------------------------------------------------
    |
    | Here routes for amulex product
    |
    */

	$router->get('certificate', ['uses' => 'Products\Amulex\CertificatesController@certificate']);
	$router->get('certificates', ['uses' => 'Products\Amulex\CertificatesController@index']);
	$router->post('createdList', ['uses' => 'Products\Amulex\CertificatesController@certificates']);
	$router->post('certificateFiles', ['uses' => 'Products\Amulex\CertificatesController@getFiles']);
	$router->post('certificateSend', ['uses' => 'Products\Amulex\CertificatesController@certificate']);
	$router->post('certificates', ['uses' => 'Products\Amulex\CertificatesController@createCertificate']);