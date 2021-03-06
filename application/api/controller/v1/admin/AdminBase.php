<?php

namespace app\api\controller\v1\admin;

use think\Config;
use think\Request;
use Util\Util;

class AdminBase extends AuthBase
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

        $whiteList = array();
        $pathInfo = Request::instance()->pathinfo();

        include_once APP_PATH . 'api/filter/adminCheckLoginList.php';
        // 是否强制使用路由
        if (Config::get('url_route_must')) {
            include_once APP_PATH . 'api/filter/filterAdminLoginPermission.php';
        }

        if (in_array($pathInfo, $whiteList)) {
            $adminUser = new AdminUser();
            if (!$adminUser->checkLogin()) {
                Util::printResult($GLOBALS['ERROR_LOGIN'], '未登录');
                exit;
            }
        }
    }
}