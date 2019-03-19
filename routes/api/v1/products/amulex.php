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
        


        $router->group(['prefix' => 'amulex'], function () use ($router) {
            $router->group(['prefix' => 'admin'], function () use ($router) {
                $router->group(['prefix' => '/users'], function () use ($router) {
                    $router->post('search', ['uses' => 'Products\Amulex\AdminController@searchUser']);
                });
                $router->group(['prefix' => '/payments'], function () use ($router) {
                    $router->get('/', ['uses' => 'Products\Amulex\AdminController@payments']);
                    $router->post('/', ['uses' => 'Products\Amulex\AdminController@createPayment']);
                    $router->post('search', ['uses' => 'Products\Amulex\AdminController@searchPayment']);
                    $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
                        $router->get('/', ['uses' => 'Products\Amulex\AdminController@getOnePayment']);
                        $router->put('/', ['uses' => 'Products\Amulex\AdminController@paymentUpdate']);
                    });
                });
                $router->group(['prefix' => '/certificates'], function () use ($router) {
                    $router->get('/', ['uses' => 'Products\Amulex\AdminController@certificates']);
                    $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
                        $router->put('/', ['uses' => 'Products\Amulex\AdminController@update']);
                    });
                });

            });

        });


