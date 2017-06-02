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
        $this->assign('scroller_img_url', ADDON_PUBLIC_PATH . '/scroller1.png');
        $this->assign('memo_img_url', ADDON_PUBLIC_PATH . '/memo1.png');
        $this->assign('background_img_url', ADDON_PUBLIC_PATH . '/background.jpg');
        $this->assign('page', '1');
        $postUrl = addons_url('ParentingActivity://ParentingActivity/previousPage');
        $this->assign('previous_url', $postUrl);
        $postUrl = addons_url('ParentingActivity://ParentingActivity/regist');
        //$postUrl = addons_url('ParentingActivity://ParentingActivity/nextPage');
        $this->assign('next_url', $postUrl);
        //$postUrl = addons_url('ParentingActivity://ParentingActivity/regist');
        //$this->assign('regist_url', $postUrl);
        addWeixinLog('ParentingActivityController::show', $this->page);
        addWeixinLog('ParentingActivityController::show', $this->scroller_img_url);
        $this->assign ( 'uid', $this->mid );
        $this->display(SITE_PATH . '/Addons/ParentingActivity/View/default/show.html');
    }

    function previousPage() {
        $pageno = $_GET['page'];
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('ParentingActivityController::previousPage', $param);
        addWeixinLog('ParentingActivityController::nextPage', $pageno);
        $this->assign('background_img_url', ADDON_PUBLIC_PATH . '/background.jpg');
        switch ($pageno) {
            case "2":
                $this->assign('page', '1');
                $this->assign('scroller_img_url', ADDON_PUBLIC_PATH . '/scroller1.png');
                $this->assign('memo_img_url', ADDON_PUBLIC_PATH . '/memo1.png');
                break;
            case "3":
                $this->assign('page', '2');
                $this->assign('scroller_img_url', ADDON_PUBLIC_PATH . '/scroller2.png');
                $this->assign('memo_img_url', ADDON_PUBLIC_PATH . '/memo2.png');
                break;
        }
        $postUrl = addons_url('ParentingActivity://ParentingActivity/previousPage');
        $this->assign('previous_url', $postUrl);
        $postUrl = addons_url('ParentingActivity://ParentingActivity/nextPage');
        $this->assign('next_url', $postUrl);
        $postUrl = addons_url('ParentingActivity://ParentingActivity/regist');
        $this->assign('regist_url', $postUrl);
        addWeixinLog('ParentingActivityController::nextPage', $this->page);
        addWeixinLog('ParentingActivityController::nextPage', $this->scroller_img_url);
        $this->display(SITE_PATH . '/Addons/ParentingActivity/View/default/show.html');
    }

    function nextPage() {
        $pageno = $_GET['page'];
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('ParentingActivityController::nextPage', $param);
        addWeixinLog('ParentingActivityController::nextPage', 'pageno=' . $pageno);
        $this->assign('background_img_url', ADDON_PUBLIC_PATH . '/background.jpg');
        switch ($pageno) {
            case "1":
                addWeixinLog('ParentingActivityController::nextPage', 'XXXX');
                $this->assign('page', '2');
                $this->assign('scroller_img_url', ADDON_PUBLIC_PATH . '/scroller2.png');
                $this->assign('memo_img_url', ADDON_PUBLIC_PATH . '/memo2.png');
                break;
            case "2":
                $this->assign('page', '3');
                $this->assign('scroller_img_url', ADDON_PUBLIC_PATH . '/scroller3.png');
                $this->assign('memo_img_url', ADDON_PUBLIC_PATH . '/memo3.png');
                break;
        }
        $postUrl = addons_url('ParentingActivity://ParentingActivity/previousPage');
        $this->assign('previous_url', $postUrl);
        $postUrl = addons_url('ParentingActivity://ParentingActivity/nextPage');
        $this->assign('next_url', $postUrl);
        $postUrl = addons_url('ParentingActivity://ParentingActivity/regist');
        $this->assign('regist_url', $postUrl);
        addWeixinLog('ParentingActivityController::nextPage', $this->page);
        addWeixinLog('ParentingActivityController::nextPage', $this->background_img_url);
        addWeixinLog('ParentingActivityController::nextPage', $this->scroller_img_url);
        addWeixinLog('ParentingActivityController::nextPage', $this->memo_img_url);
       $this->display(SITE_PATH . '/Addons/ParentingActivity/View/default/show.html');
    }

    function regist() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
         addWeixinLog('ParentingActivityController::regist', $param);
       $uid = $this->mid;
        $this->assign('uid', $uid);
        $this->display(SITE_PATH . '/Addons/WemallShop/View/default/show.html');
    }

}
