<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'product' => 'c,r,u,d',

            'profile' => 'r,u',
        ],
        'admin' => [
            'users' => 'c,r,u',
            'profile' => 'r,u',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
       
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
