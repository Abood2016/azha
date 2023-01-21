<?php
// Aside menu
return [

    'items' => [
        [
            'title' => 'الرئيسية',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'المستخدمين',
            'root' => true,
            'icon' => 'media/svg/icons/Media/Rec.svg',
            'new-tab' => false,
            'bullet' => 'dot',
            'submenu' => [
                // [
                //     'title' => 'المشرفين',
                //     'page' => 'admins'
                // ],
                // [
                //     'title' => 'Business',
                //     'page' => 'admin-business'
                // ],
                // [
                //     'title' => 'Drivers',
                //     'page' => 'drivers'
                // ],
                [
                    'title' => 'العملاء',
                    'page' => 'customers'
                ],
                [
                    'title' => 'أصحاب الخدمات',
                    'page' => 'recruiters'
                ],

            ]
        ],

        // [
        //     'title' => 'الصلاحيات',
        //     'root' => true,
        //     'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
        //     'page' => '/roles',
        //     'new-tab' => false,
        // ],

        [
            'title' => 'الأقسام',
            'root' => true,
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'new-tab' => false,
            'bullet' => 'dot',
            'submenu' => [

                [
                    'title' => 'الأقسام الرئيسية',
                    'page' => 'categories'
                ],
                [
                    'title' => 'الأقسام الفرعية',
                    'page' => 'sub-categories'
                ],

            ]
        ],


        [
        'title' => 'الخدمات',
        'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
        'root' => true,
        'page' =>'services  ',
        'new-tab' => false,
        ],


        // [
        //     'title' => 'Types',
        //     'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
        //     'root' => true,
        //     'page' =>'types',
        //     'new-tab' => false,
        // ],
        // [
        //     'title' => 'Places',
        //     'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
        //     'root' => true,
        //     'page' =>'places',
        //     'new-tab' => false,
        // ],
        // [
        //     'title' => 'Orders',
        //     'root' => true,
        //     'icon' => 'media/svg/icons/Communication/Clipboard-list.svg',
        //     'new-tab' => false,
        //     'bullet' => 'dot',
        //     'submenu' => [
        //         [
        //             'title' => 'All Orders (System)',
        //             'page' => 'orders'
        //         ],
        //         [
        //             'title' => 'All Orders ( Business)',
        //             'page' => 'admin/business/orders'
        //         ],
//                [
//                    'title' => 'Setting (Normal)',
//                    'page' => 'orders-setting-normal'
//                ],
//                [
//                    'title' => 'Setting (Barq)',
//                    'page' => 'orders-setting-barq'
//                ],
//                [
//                    'title' => 'Setting (Business)',
//                    'page' => 'orders-business-setting'
//                ],
        //     ]
        // ],
//        [
                [
            'title' => 'الطلبات',
            'root' => true,
            'icon' => 'media/svg/icons/Communication/Clipboard-list.svg',
            'page' => 'orders',
            'new-tab' => false,
        ],

//        [
//            'title' => 'Wallet',
//            'root' => true,
//            'icon' => 'media/svg/icons/Shopping/Wallet.svg',
//            'page' => 'wallet',
//            'new-tab' => false,
//        ],
//        [
//            'title' => 'Transactions',
//            'root' => true,
//            'icon' => 'media/svg/icons/Shopping/ATM.svg',
//            'page' => 'transactions',
//            'new-tab' => false,
//        ],
//        [
//            'title' => 'Promocodes',
//            'root' => true,
//            'icon' => 'media/svg/icons/Shopping/Sale2.svg',
//            'page' => 'promocodes',
//            'new-tab' => false,
//        ],
        // [
        //     'title' => 'Notifications',
        //     'root' => true,
        //     'icon' => 'media/svg/icons/General/Notifications1.svg',
        //     'new-tab' => false,
        //     'bullet' => 'dot',
        //     'submenu' => [
        //         [
        //             'title' => 'To Customer',
        //             'page' => 'customer/notifications/create'
        //         ],
        //         [
        //             'title' => 'To Driver',
        //             'page' => 'driver/notifications/create'
        //         ]
        //     ]
        // ],

        //media/svg/icons/Communication/Spam.svg
        [
            'title' => 'البنرات',
            'root' => true,
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'page' => 'sliders',
            'new-tab' => false,
        ],

        [
            'title' => 'طلبات التواصل',
            'root' => true,
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'page' => 'contact-us',
            'new-tab' => false,
        ],
        [
            'title' => 'الأعدادت العامة',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'root' => true,
            'page' =>'settings',
            'new-tab' => false,
        ],

    ]

];
