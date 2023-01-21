<?php
// Aside menu
return [

    'items' => [
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'Catalogue',
            'desc' => '',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Categories',
                    'page' => 'categories'
                ],
                [
                    'title' => 'Services',
                    'page' => 'services'
                ]
            ]
        ],
        [
            'title' => 'Drivers',
            'root' => true,
            'icon' => 'media/svg/icons/Media/Rec.svg',
            'page' => 'drivers',
            'new-tab' => false,
        ],
        [
            'title' => 'Customers',
            'root' => true,
            'icon' => 'media/svg/icons/Communication/Group.svg',
            'page' => 'customers',
            'new-tab' => false,
        ],
        [
            'title' => 'Bookings',
            'root' => true,
            'icon' => 'media/svg/icons/Communication/Clipboard-list.svg',
            'page' => 'bookings',
            'new-tab' => false,
        ],
        [
            'title' => 'Trips',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Key.svg',
            'page' => 'trips',
            'new-tab' => false,
        ],
        [
            'title' => 'Ratings',
            'root' => true,
            'icon' => 'media/svg/icons/General/Star.svg',
            'page' => 'ratings',
            'new-tab' => false,
        ],
        [
            'title' => 'Wallet',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Wallet.svg',
            'page' => 'wallet',
            'new-tab' => false,
        ],
        [
            'title' => 'Transactions',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/ATM.svg',
            'page' => 'transactions',
            'new-tab' => false,
        ],
        [
            'title' => 'Promocodes',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Sale2.svg',
            'page' => 'promocodes',
            'new-tab' => false,
        ],
        [
            'title' => 'Notifications',
            'root' => true,
            'icon' => 'media/svg/icons/General/Notifications1.svg',
            'new-tab' => false,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'To All Customer',
                    'page' => 'notifications/create'
                ],
                [
                    'title' => 'To a Specific Customer',
                    'page' => 'customer/notifications/create'
                ]
            ]
        ],
        [
            'title' => 'Reasons for cancellation',
            'root' => true,
            'icon' => 'media/svg/icons/Communication/Spam.svg',
            'page' => 'peeps',
            'new-tab' => false,
        ],
        [
            'title' => 'Settings',
            'root' => true,
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'page' => 'settings',
            'new-tab' => false,
        ],
    ]

];
