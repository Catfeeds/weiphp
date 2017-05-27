<?php

namespace Addons\ParentingActivity\Controller;
use Home\Controller\AddonsController;

class ParentingActivityController extends AddonsController{
    function _initialize() {
        parent::_initialize();
    }

    // 开始领取页面
    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('ParentingActivityController', $param);
        $this->display(SITE_PATH . '/Addons/ParentingActivity/View/default/show.html');
    }

}