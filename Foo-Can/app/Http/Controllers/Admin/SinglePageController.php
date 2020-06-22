<?php

/**
 * Created by PhpStorm.
 * User: darryldecode
 * Date: 4/2/2018
 * Time: 8:40 AM
 */

namespace App\Http\Controllers\Admin;


use App\Components\Core\Menu\MenuItem;
use App\Components\Core\Menu\MenuManager;
use App\Components\User\Models\User;

class SinglePageController extends AdminController
{
    public function displaySPA()
    {
        /**
         * @var User $currentUser
         */
        $currentUser = \Auth::user();
        $menuManager = new MenuManager();
        $menuManager->setUser($currentUser);
        $menuManager->addMenus([
            //Dashboard
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Dashboard',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'dashboard',
                'route_type' => 'vue',
                'route_name' => 'dashboard',
                'visible' => true,
            ]),
            //Card
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Card',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'credit_card',
                'route_type' => 'vue',
                'route_name' => 'card',
                'visible' => true,
            ]),
            //CardAmount
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Card Amount',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'payment',
                'route_type' => 'vue',
                'route_name' => 'cardamount',
                'visible' => true,
            ]),
            //CardType
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Card Type',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'payment',
                'route_type' => 'vue',
                'route_name' => 'cardtype',
                'visible' => true,
            ]),
            //shop
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Shop',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'shop',
                'route_type' => 'vue',
                'route_name' => 'shop',
                'visible' => true,
            ]),
            //User
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'User',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'person',
                'route_type' => 'vue',
                'route_name' => 'users.list',
                'visible' => true,
            ]),
            //Record
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Record',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'cloud_circle',
                'route_type' => 'vue',
                'route_name' => 'record',
                'visible' => true,
            ]),
            //Report
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Reports',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'report',
                'route_type' => 'vue',
                'route_name' => 'Report',
                'visible' => true,
            ]),
            //setting
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'Settings',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'settings',
                'route_type' => 'vue',
                'route_name' => 'settings',
                'visible' => true,
            ]),
            //AboutUs
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label' => 'About Us',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon' => 'supervised_user_circle',
                'route_type' => 'vue',
                'route_name' => 'aboutus',
                'visible' => true,
            ]),



            new MenuItem([
                'nav_type' => MenuItem::$NAV_TYPE_DIVIDER
            ])
        ]);

        $menus = $menuManager->getFiltered();

        view()->share('nav', $menus);

        return view('layouts.admin');
    }
}
