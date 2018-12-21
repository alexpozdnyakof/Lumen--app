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
    $router->get('/api/v1/Krm/Decompress/{app_number}', 'KrmController@Decompress'); //1 выгрузить все файлы и все архивы
    $router->get('/api/v1/Krm/ResizeImages/{app_number}', 'KrmController@ResizeImages'); //2 пройтись по всем файлам, сделать ресайз картинок.
    $router->get('/api/v1/Krm/PackArchive/{app_number}', 'KrmController@PackArchive');//3 запаковать всё в один большой архив, удалить мусор.
    $router->get('/api/v1/Krm/SaveArchive/{app_number}', 'KrmController@SaveArchive');//4 заменить готовым архивом - текущие все имеющиеся файлы (удалив их, обновив krm_files)



    $router->get('/api/v1/Krm/phpinfo', 'KrmController@phpinfo');

    $router->get('/api/v1/Krm/CountWorkTime/{started}[/{time_ended}]', 'KrmController@CountWorkTime');
    $router->get('/api/v1/Krm/CheckIfVacation/{date}/', 'KrmController@CheckIfVacation');
    $router->get('/api/v1/User/Whoaim', 'UserController@Whoaim');
    $router->get('/api/v1/Krm/GetPayrollPackage/{atm}/{sms}/{kassa}/{dbo_rur}/{dbo_usd}/{sbo}/', 'KrmController@GetPayrollPackage');

    //Call-Center
    $router->get('/api/v1/CallCenter/GetDevices', 'CallCenter@GetDevices');


    //CRM
    //Выдача карточка проспекта
    $router->get('/Crm/Prospect/{prospect_id}[/GetProspect]',['uses'=>'Crm@GetProspect','middleware'=>'Auth']);
    //Выдача списков по пользователю {uid} , либо своего.
    $router->get('/Crm/SpisokPersonal[/{uid}]', ['uses'=>'Crm@GetPersonSpiski','middleware'=>'Auth']);
    $router->get('/Crm/SpisokPersonal/{uid}/{spisok_id}[/{page}]', ['uses'=>'Crm@GetPersonSpisokExpand','middleware'=>'Auth']);
    //Выдача списков по терофису {terofis}
    $router->get('/Crm/SpisokTerofis/{terofis}', ['uses'=>'Crm@GetTerofisSpiski','middleware'=>'Auth']);
