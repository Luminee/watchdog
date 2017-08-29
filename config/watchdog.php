<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Option of escalator
    |--------------------------------------------------------------------------
    |
    | You should define your controller namespace with module and version like:
    | 'namespace App\Http\Controllers\User\v1_0;' so the escalator can get
    | the module, then fetch versions by the module through array below.
    |
    */
    
    'ignore_route' => [
        
        '/api/auth/login'
        
    ],
    
];
