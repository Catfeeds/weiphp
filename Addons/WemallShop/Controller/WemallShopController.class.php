<?php

namespace Addons\WemallShop\Controller;
use Home\Controller\AddonsController;

class WemallShopController extends AddonsController{
   function _initialize() {
        parent::_initialize();
    }

    // 开始领取页面
    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('WemallShopController', $param);
        $uid = $this->mid;
        $this->assign ( 'uid', $uid );
        $this->display(SITE_PATH . '/Addons/WemallShop/View/default/show.html');
    }

}
