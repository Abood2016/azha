<?php

namespace App\Http\Controllers\Dashboard\Metronic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuAsideController extends Controller
{
    public static function generateMenu(){
        $arr = array();
        $prefix = '';
        if(auth()->user()->role == 4)
            $prefix.= 'business';
        //-------------------------------------------------------------------
        array_push($arr,[
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => $prefix.'/',
            'new-tab' => false,
        ]);

        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('types-read')){
            array_push($arr,[
                'title' => 'Types',
                'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
                'root' => true,
                'page' =>'types',
                'new-tab' => false,
            ]);
        }
        if(auth()->user()->isAbleTo('places-read')){
            array_push($arr,[
                'title' => 'Places',
                'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
                'root' => true,
                'page' =>'places',
                'new-tab' => false,
            ]);
        }
//        $catalogue = [
//            'title' => 'Catalogue',
//            'desc' => '',
//            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
//            'bullet' => 'dot',
//            'root' => true,
//            'submenu' => $submenu_catalogue
//        ];
//
//        array_push($arr,$catalogue);
        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('admins-read')){
            array_push($arr,[
                'title' => 'Admins',
                'root' => true,
                'icon' => 'media/svg/icons/Media/Rec.svg',
                'page' => 'admins',
                'new-tab' => false,
            ]);
        }
        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('drivers-read')){

            array_push($arr,[
                'title' => 'Drivers',
                'root' => true,
                'icon' => 'media/svg/icons/Media/Rec.svg',
                'page' => 'drivers',
                'new-tab' => false,
            ]);
        }
        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('customers-read')){
            array_push($arr,[
                'title' => 'Customers',
                'root' => true,
                'icon' => 'media/svg/icons/Communication/Group.svg',
                'page' => $prefix.'/customers',
                'new-tab' => false,
            ]);
        }
        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('orders-read') || auth()->user()->role == 4){
            array_push($arr,[
                'title' => 'Orders',
                'root' => true,
                'icon' => 'media/svg/icons/Communication/Clipboard-list.svg',
                'page' => $prefix.'/orders',
                'new-tab' => false,
            ]);
        }

        //-------------------------------------------------------------------
//        if(auth()->user()->isAbleTo('ratings-read')){
//            array_push($arr,[
//                'title' => 'Ratings',
//                'root' => true,
//                'icon' => 'media/svg/icons/General/Star.svg',
//                'page' => 'ratings',
//                'new-tab' => false,
//            ]);
//        }
        //-------------------------------------------------------------------
//        if(auth()->user()->isAbleTo('wallet-read')){
//            array_push($arr,[
//                'title' => 'Wallet',
//                'root' => true,
//                'icon' => 'media/svg/icons/Shopping/Wallet.svg',
//                'page' => 'wallet',
//                'new-tab' => false,
//            ]);
//        }
        //-------------------------------------------------------------------
//        array_push($arr,[
//            'title' => 'Transactions',
//            'root' => true,
//            'icon' => 'media/svg/icons/Shopping/ATM.svg',
//            'page' => 'transactions',
//            'new-tab' => false,
//        ]);
        //-------------------------------------------------------------------
//        array_push($arr,[
//            'title' => 'Promocodes',
//            'root' => true,
//            'icon' => 'media/svg/icons/Shopping/Sale2.svg',
//            'page' => 'promocodes',
//            'new-tab' => false,
//        ]);
        //-------------------------------------------------------------------
//        if(auth()->user()->isAbleTo('notifications-read')){
//            array_push($arr,[
//                'title' => 'Notifications',
//                'root' => true,
//                'icon' => 'media/svg/icons/General/Notifications1.svg',
//                'new-tab' => false,
//                'bullet' => 'dot',
//                'submenu' => [
//                    [
//                        'title' => 'To All Customer',
//                        'page' => 'notifications/create'
//                    ],
//                    [
//                        'title' => 'To a Specific Customer',
//                        'page' => 'customer/notifications/create'
//                    ]
//                ]
//            ]);
//        }
        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('peeps-read')){
            array_push($arr,[
                'title' => 'Peeps',
                'root' => true,
                'icon' => 'media/svg/icons/Communication/Spam.svg',
                'new-tab' => false,
                'bullet' => 'dot',
                'submenu' => [
                    [
                        'title' => 'Cancel Peeps',
                        'page' => 'peeps'
                    ],
                    [
                        'title' => 'Cancel Pending Peeps',
                        'page' => 'pending/peeps'
                    ],
                    [
                        'title' => 'Bad Rating Peeps',
                        'page' => 'bad-rating/peeps'
                    ]
                ]
            ]);
        }
        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('supports-read')){
            array_push($arr,[
                'title' => 'Supports',
                'root' => true,
                'icon' => 'media/svg/icons/General/Settings-2.svg',
                'page' => 'supports',
                'new-tab' => false,
            ]);
        }
        //-------------------------------------------------------------------
        if(auth()->user()->isAbleTo('settings-read')){
            array_push($arr,[
                'title' => 'Settings',
                'root' => true,
                'icon' => 'media/svg/icons/General/Settings-2.svg',
                'page' => 'settings',
                'new-tab' => false,
            ]);
        }
        //-------------------------------------------------------------------










        $menu_aside = ['items' => $arr];
        return $menu_aside;
    }
}