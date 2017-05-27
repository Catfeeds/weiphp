<?php

namespace Addons\XIXILovePinYin\Controller;
use Home\Controller\AddonsController;

class PinYinController extends AddonsController {
    
    function _initialize() {
        parent::_initialize();
    }
	
	// 开始领取页面
	function show() {
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();
		
		addWeixinLog ( 'PinYinController', $param );
		
		$this->display ( SITE_PATH . '/Addons/XIXILovePinYin/View/default/show.html' );
	}
}
