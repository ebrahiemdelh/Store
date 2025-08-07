<?php
return [
    [
        'icon' => 'nav-icon fas fa-house-user',

        'route' => 'dashboard.home',
        'title' => 'Home',
    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'color' => 'danger',
        'ability' => 'categories.view',
    ],
    [
        'icon' => 'nav-icon fas fa-barcode',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'badge'=>'updated',
        'color'=>'success',
        'ability' => 'products.view',
    ],
    [
        'icon' => 'nav-icon fas fa-shield-alt',
        'route' => 'dashboard.roles.index',
        'title' => 'Roles',
        'badge'=>'updated',
        'color'=>'success',
        'ability' => 'roles.view',
    ],
    // [
    //     'icon' => 'nav-icon fas fa-receipt',
    //     'route' => 'dashboard.orders.index',
    //     'title' => 'Orders',
    //     'badge'=>'updated',
    //     'color'=>'success',
    //     'ability' => 'orders.view',
    // ],
];
