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

        'superAdministrator' => [
            'all-users' => 'c,r,u,d',
            'country-users' => 'c,r,u,d',
            'all-city' => 'c,r,u,d',
            'country-city' => 'c,r,u,d',
            'all-department' => 'c,r,u,d',
            'country-department' => 'c,r,u,d',
            'sub-department' => 'c,r,u,d',
            'all-company' => 'c,r,u,d',
            'country-company' => 'c,r,u,d',
            'all-advertisement' => 'c,r,u,d',
            'country-advertisement' => 'c,r,u,d',
            'whats-new' => 'c,r,u,d',
            'notification' => 'c,r',
            'image' => 'c,r,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'country-users' => 'c,r,u,d',
            'country-city' => 'c,r,u,d',
            'country-department' => 'c,r,u,d',
            'sub-department' => 'c,r,u,d',
            'country-company' => 'c,r,u,d',
            'country-advertisement' => 'c,r,u,d',
            'whats-new' => 'c,r,u,d',
            'notification' => 'c,r',
            'image' => 'c,r,d',
            'profile' => 'r,u'
        ],
        'admin' => [
            'country-users' => 'c,r,u',
            'profile' => 'r,u'
        ]

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
