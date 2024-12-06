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
        'color' => 'danger'
    ],
    [
        'icon' => 'nav-icon fas fa-barcode',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'badge'=>'updated',
        'color'=>'success'
    ],
];
