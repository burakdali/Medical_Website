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
        'admin' => [
            'users' => 'c,r,u,d',
            'comment' => 'c,r,u,d',
            'article' => 'c,r,u,d',
            'consult' => 'r,u,d',
            'consult_reply' => 'c,r,u,d'
        ],
        'doctor' => [
            'users' => 'c',
            'comment' => 'c,r',
            'article' => 'c,r,u,d',
            'consult' => 'r',
            'consult_reply' => 'c,r,u,d'
        ],
        'user' => [
            'users' => 'c',
            'comment' => 'c,r,u,d',
            'article' => 'r',
            'consult' => 'c,r,u,d',
            'consult_reply' => 'r,u,d'
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
