<?php
    /*
    |--------------------------------------------------------------------------
    | Amulex Routes
    |--------------------------------------------------------------------------
    |
    | Here routes for amulex product
    |
    */

	$router->get('certificate', ['uses' => 'Products\CertificatesController@certificate']);
	$router->get('certificates', ['uses' => 'Products\CertificatesController@index']);
	$router->post('createdList', ['uses' => 'Products\CertificatesController@certificates']);
	$router->post('certificateFiles', ['uses' => 'Products\CertificatesController@getFiles']);
	$router->post('certificateSend', ['uses' => 'Products\CertificatesController@certificate']);
	$router->post('certificates', ['uses' => 'Products\CertificatesController@createCertificate']);