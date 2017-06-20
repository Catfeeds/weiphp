<?php

namespace Addons\TimeBank\Controller;
use Home\Controller\AddonsController;

class TimeBankController extends AddonsController{
    function _initialize() {
        parent::_initialize();
    }

    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('TimeBankController::show', $param);
        $balance = "30";
        $this->assign ( 'balance', $balance );
        $this->display(SITE_PATH . '/Addons/TimeBank/View/default/Show.html');
    }

}
