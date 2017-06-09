<?php

namespace Addons\ParentingActivity\Controller;

use Home\Controller\AddonsController;

class ParentingActivityController extends AddonsController {

    var $table = 'wp_ParentingActivity';

    function _initialize() {
        parent::_initialize();
    }

    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('ParentingActivityController::show', $param);
        $this->display(SITE_PATH . '/Addons/ParentingActivity/View/default/demo1.html');
    }

    function regist() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('ParentingActivityController::regist', $param);

        $this->display(SITE_PATH . '/Addons/ParentingActivity/View/default/regist.html');
    }

}
