<?php

return [

    'ignore_route' => [

        '/api/auth/login'

    ],

    /**
     * Relation Account Model
     */
    'account' => [

        'model' => 'App\Models\User\Account',

        'name' => 'nickname'

    ],

    /**
     * Super Admin Role ID.
     * Super Admin will ignore gate check, and allow access all route.
     */
    'super_admin_id' => 1,

];
