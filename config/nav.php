<?php
return [
    [
        'icon' => 'nav-icon fas fa-house-user',

        'route' => 'dashboard',
        'title' => 'Home',
    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'color' => 'danger'
    ],
    [
        'icon' => 'nav-icon fas fa-barcode',
        'route' => 'products.index',
        'title' => 'Products',
        'badge'=>'updated',
        'color'=>'success'
    ],
];
