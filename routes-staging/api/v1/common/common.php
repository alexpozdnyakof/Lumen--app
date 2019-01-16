<?php
    /*
    |--------------------------------------------------------------------------
    | MadeByTim Routes
    |--------------------------------------------------------------------------
    |
    | Here routes created by Tim
    |
    */
    //KRM
    //Функции КРМ (bpm-модуль):
    $router->get('/api/v1/Krm/Decompress/{app_number}', 'Common\KrmController@Decompress'); //1 выгрузить все файлы и все архивы
    $router->get('/api/v1/Krm/ListDecompressedFiles/{app_number}[/{ext}]', 'Common\KrmController@ListDecompressedFiles'); //1 выгрузить все файлы и все архивы
    $router->get('/api/v1/Krm/ResizeImages/{app_number}', 'Common\KrmController@ResizeImages'); //2 пройтись по всем файлам, сделать ресайз картинок.
    $router->get('/api/v1/Krm/PackArchive/{app_number}', 'Common\KrmController@PackArchive');//3 запаковать всё в один большой архив, удалить мусор.
    $router->get('/api/v1/Krm/SaveArchive/{app_number}', 'Common\KrmController@SaveArchive');//4 заменить готовым архивом - текущие все имеющиеся файлы (удалив их, обновив krm_files)



    $router->get('/api/v1/Krm/phpinfo', 'Common\KrmController@phpinfo');

    $router->get('/api/v1/Krm/CountWorkTime/{started}[/{time_ended}]', 'Common\KrmController@CountWorkTime');
    $router->get('/api/v1/Krm/CheckIfVacation/{date}/', 'Common\KrmController@CheckIfVacation');
    $router->get('/api/v1/User/Whoaim', 'Common\UserController@Whoaim');
    $router->get('/api/v1/Krm/GetPayrollPackage/{atm}/{sms}/{kassa}/{dbo_rur}/{dbo_usd}/{sbo}/', 'Common\KrmController@GetPayrollPackage');

    //Call-Center
    $router->get('/api/v1/CallCenter/GetDevices', 'Common\CallCenter@GetDevices');


    //CRM
    //Выдача карточка проспекта
    $router->get('/Crm/Prospect/{prospect_id}[/GetProspect]',['uses'=>'Common\Crm@GetProspect','middleware'=>'Auth']);
    //Выдача списков по пользователю {uid} , либо своего.
    $router->get('/Crm/SpisokPersonal[/{uid}]', ['uses'=>'Common\Crm@GetPersonSpiski','middleware'=>'Auth']);
    $router->get('/Crm/SpisokPersonal/{uid}/{spisok_id}[/{page}]', ['uses'=>'Common\Crm@GetPersonSpisokExpand','middleware'=>'Auth']);
    //Выдача списков по терофису {terofis}
    $router->get('/Crm/SpisokTerofis/{terofis}', ['uses'=>'Common\Crm@GetTerofisSpiski','middleware'=>'Auth']);
