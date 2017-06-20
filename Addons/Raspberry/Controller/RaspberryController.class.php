<?php

namespace Addons\Raspberry\Controller;

use Home\Controller\AddonsController;

class RaspberryController extends AddonsController {

    function _initialize() {
        parent::_initialize();
    }

    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();

        addWeixinLog('RaspberryController', $param);
        //phpinfo();
//        $url = 'http://syue77.imwork.net/publiccenter/services/weichatService?wsdl';
//        $soap = new \SoapClient($url, array('trace' => true, 'soap_version' => SOAP_1_1));
//        try {
//            echo '222222';
//            echo $soap->getWeichat(1, 2, 3, 4);
//            echo '333333';
//            unset($soap);
//        } catch (SoapFault $fault) {
//            var_dump($fault);
//        }
        //$this->display(SITE_PATH . '/Addons/Raspberry/View/default/show.html');
        redirect('http://syue77.imwork.net/publiccenter/');
    }

}
