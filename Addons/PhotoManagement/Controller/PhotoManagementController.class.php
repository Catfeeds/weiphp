<?php

namespace Addons\PhotoManagement\Controller;
use Home\Controller\AddonsController;

class PhotoManagementController extends AddonsController{
    function _initialize() {
        parent::_initialize();
    }
    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('PhotoManagementController', $param);
        redirect('http://shzhuhui.wicp.net/photo/');
    }
}
