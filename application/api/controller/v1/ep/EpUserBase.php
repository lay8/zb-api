<?php

namespace app\api\controller\v1\ep;

use app\api\controller\v1\AuthBase;
use think\Request;

class EpUserBase extends AuthBase
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $whiteList = array();
        $pathInfo = Request::instance()->pathinfo();
        include_once APP_PATH . 'api/filter/enterPriseCheckLoginList.php';

        if (in_array($pathInfo, $whiteList)) {
            $epUser = new EpUser();
            $epUser->checkLogin();
        }
    }
}