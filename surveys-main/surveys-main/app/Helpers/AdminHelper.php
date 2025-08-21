<?php

use App\Models\admin\Menu;
use App\Models\admin\MenuPermission;
use Jenssegers\Agent\Agent;

function getTopNavCat($userId)
{
    $menus = Menu::parents($userId)->with('childrenRecursive')->get();
    return generateMenuHtml($menus, 0);
}


function generateMenuHtml($menus, $level)
{
    $html = '';

    if ($level == 1) {
        $html .= '<ul class="nav nav-treeview">';
    }
    foreach ($menus as $item) {
        $isActive = request()->is('admin/' . $item['route']) || isActiveChildMenu($item['children']) ? 'active menu-open' : '';
        if (count($item['children']) > 0) {
            $url = "/admin/" . $item['route'];
            $html .= '<li class="nav-item has-treeview ' . $isActive . '"><a class="nav-link ' . $isActive . '" href="javascript:void(0);"> ' . $item['icon'] . ' <p>' . $item['name'] . '<i class="right fas fa-angle-left"></i></p></a>';
            $html .= generateMenuHtml($item['children'], 1);
        } else {
            $url = "/admin/" . $item['route'];
            if ($item['route'] && !empty(MenuPermission::where(['menu_id' => $item['id'], 'user_id' => session('surveysAdmin.userId')])->first()) ){
                $html .= '<li class="nav-item ' . $isActive . '"><a class="nav-link ' . $isActive . '" href="' . $url . '"> ' . $item['icon'] . '<p>' . $item['name'] . '</p></a>';
            }
        }

        $html .= '</li>';
    }
    if ($level == 1) {
        $html .= '</ul>';
    }

    return $html;
}

function isActiveChildMenu($children)
{
    foreach ($children as $item) {
        if (request()->is('admin/' . $item['route']) || isActiveChildMenu($item['children'])) {
            return true;
        }
    }

    return false;
}


if (!function_exists('getUserBrowserName')) {
    function getUserBrowserName()
    {
        $agent = new Agent();
        $browserName = $agent->browser();
        return $browserName;

    }
}

if (!function_exists('getUserPlatform')) {
    function getUserPlatform()
    {
        $agent = new Agent();
        $platform = $agent->platform();
        return $platform;

    }
}


if (!function_exists('getUserIPAddress')) {
    function getUserIPAddress()
    {
        $agent = new Agent();
        $ipAddress = request()->ip();
        return $ipAddress;

    }
}

function getEditData($mode, $arrayData, $filled, $imagePath = "")
{
    $value = "";
    if ($mode == "Edit" && !empty($arrayData)) {
        $value = $arrayData->$filled;
        if ($imagePath != "" && $arrayData->$filled != "") {
            $value = $imagePath . "/" . $arrayData->$filled;
        }
    }
    return $value;
}
