<?php

namespace Addons\Raspberry\Controller;
use Home\Controller\AddonsController;

class RaspberryController extends AddonsController{
   function _initialize() {
        parent::_initialize();
    }

    // 开始领取页面
    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();

        addWeixinLog('RaspberryController', $param);


        $this->display(SITE_PATH . '/Addons/Raspberry/View/default/show.html');
    }

}
