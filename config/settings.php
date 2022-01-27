<?php
    /*
    |--------------------------------------------------------------------------
    | Default Site Settings
    |--------------------------------------------------------------------------
    */
	return [
		'menus' => [
			'Primary' => 'primary',
		],
		'permissions' => [
            'Pages' =>[
                'View Pages' => 'viewPages',
                'Add Pages' =>'addPages',
                'Update Pages' =>'updatePages',
                'Delete Pages' =>'deletePages',
            ],
            'Menus' => [
                'View Menus' =>'viewMenus',
                'Add Menus' =>'addMenus'
            ],
            'Blogs' => [
                'View Blogs' =>'viewBlogs',
                'Add Blogs' =>'addBlogs',
                'Update Blogs' =>'updateBlogs',
                'Delete Blogs' =>'deleteBlogs',
            ],
            'Categories' => [
                'View Categories' =>'viewCategories',
                'Add Categories' =>'addCategories',
                'Update Categories' =>'updateCategories',
                'Delete Categories' =>'deleteCategories',
            ],
            'Users' => [
                'View Users' =>'viewUsers',
                'Add Users' =>'addUsers',
                'Update Users' =>'updateUsers',
                'Delete Users' =>'deleteUsers',
            ],            
            'Roles' => [
                'View Roles' =>'viewRoles',
                'Add Roles' =>'addRoles',
                'Update Roles' =>'updateRoles',
                'Delete Roles' =>'deleteRoles',
            ],
            'Dashboard & Settings' => [
                'Access Settings' =>'accessSettings',
                'Access Dashboard' =>'accessDashboard',
            ],
        ],
        'settings' => [
            'general' => [
                'site_name' => env('APP_NAME', 'Laravel App'),
                'site_title' => env('APP_NAME', 'Laravel App'),
                'home_page' => 'default',
            ],
            'registration' => [
                'default_role' => 'Admin',
                'email_verification_on_reg' => 1,
                'allow_registrstion' => 1,
                'allow_forget_password' => false,
            ],
            'email' => [
                'MAIL_DRIVER' => env('MAIL_DRIVER'),
                'MAIL_HOST' => env('MAIL_HOST'),
                'MAIL_PORT' => env('MAIL_PORT'),
                'MAIL_USERNAME' => env('MAIL_USERNAME'),
                'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
                'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
                'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
            ],
        ],
	];