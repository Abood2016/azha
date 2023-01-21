<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d',
            'drivers' => 'c,r,u,d',
            'customers' => 'c,r,u,d',
            'types' => 'c,r,u,d',
            'places' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
//            'ratings' => 'r',
//            'wallet' => 'r',
//            'notifications' => 'r,c',
            'peeps' => 'c,r,u,d',
            'settings' => 'r',
            'supports' => 'r',
        ],
        'admin' =>[],
        'business' =>[
            'orders' => 'c,r,u,d',
            'customers' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
