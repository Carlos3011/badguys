<?php

return [
    'modules' => [
        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */
        Vanilo\Foundation\Providers\ModuleServiceProvider::class,
        Konekt\AppShell\Providers\ModuleServiceProvider::class => [
            'ui' => [
                'name' => 'Shop Admin', // Your app's name to display on admin
                'url'  => '/admin/product', // Base/Home URL after login (eg. dashboard)
            ],
        ],
        Vanilo\Admin\Providers\ModuleServiceProvider::class,
        
    ],
    'register_route_models' => true
];
