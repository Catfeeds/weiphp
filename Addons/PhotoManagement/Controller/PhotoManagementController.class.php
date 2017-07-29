<?php

//require_once('Qiniu/functions.php');

namespace Addons\PhotoManagement\Controller;

use Home\Controller\AddonsController;

class PhotoManagementController extends AddonsController {

    function _initialize() {
        parent::_initialize();
    }

    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('PhotoManagementController:show', $param);
        $map['type'] = "0";
        $piccnt = M('photo_management')->where($map)->count();
        $map['type'] = "1";
        $videocnt = M('photo_management')->where($map)->count();
        
        $data=M('photo_management')->field('distinct flag')->select();
        addWeixinLog('PhotoManagementController:show', $data);
        $this->assign('flaglist', $data);
        
        $type = I("type");
        $startDate = I("startDate");
        $endDate = I("endDate");
        $flag = I("flag");
        $memo = I("memo");
        $hidden = I("hidden");

        $this->assign('piccnt', $piccnt);
        $this->assign('videocnt', $videocnt);
        $this->assign('type', $type);
        $this->assign('startDate', $startDate);
        $this->assign('endDate', $endDate);
        $this->assign('flag', $flag);
        $this->assign('hidden', $hidden);
        $this->assign('memo', $memo);

        $this->display(SITE_PATH . '/Addons/PhotoManagement/View/default/Show.html');
    }

    function showList() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('PhotoManagementController::showList', $param);

        $page = I('page', 1, 'intval'); // 默认显示第一页数据
        $row = 30;
        $type = I('type');
        $startDate = I('startDate');
        $endDate = I('endDate');
        $flag = I('flag');
        $memo = I('memo');
        $hidden = I('hidden');

        $this->assign('type', $type);
        $this->assign('startDate', $startDate);
        $this->assign('endDate', $endDate);
        $this->assign('flag', $flag);
        $this->assign('hidden', $hidden);
        $this->assign('memo', $memo);


        if (!empty($startDate) && !empty($endDate)) {
            $startDate = str_replace('-', '', $startDate) . '000000';
            $endDate = str_replace('-', '', $endDate) . '235959';
            $map['name'] = array('between', array($startDate, $endDate));
        } else if (!empty($startDate)) {
            $startDate = str_replace('-', '', $startDate) . '000000';
            $map['name'] = array('egt', $startDate);
        } else if (!empty($endDate)) {
            $endDate = str_replace('-', '', $endDate) . '235959';
            $map['name'] = array('elt', $endDate);
        }

        $map['type'] = $type;
        if (!empty($flag)) {
            $map['flag'] = array('like', '%' . $flag . '%');
        }
        if (!empty($memo)) {
            $map['memo'] = array('like', '%' . $memo . '%');
        }

        if (!empty($hidden)) {
            $map['hidden'] = $hidden;
        } else {
            $map['hidden'] = '0';
        }
        addWeixinLog('PhotoManagementController::showList', $map);
        $cnt = M('photo_management')->where($map)->count();
        if ($cnt % $row > 0) {
            $totalPages = intval($cnt / $row) + 1;
        } else {
            $totalPages = intval($cnt / $row);
        }
        addWeixinLog('PhotoManagementController::showList', $totalPages);
        addWeixinLog('PhotoManagementController::showList', $page);
        addWeixinLog('PhotoManagementController::showList', $cnt);
        $this->assign('totalPages', $totalPages);
        $this->assign('page', $page);

        $data = M('photo_management')->where($map)->order('name desc')->page($page, $row)->select();
        foreach ($data as &$c) {
            $c['short'] = 'http://image.syue77.top/' . $c['name'] . '.jpg?imageView2/1/w/120/h/120';
        }
        $this->assign('data', $data);

        $this->display(SITE_PATH . '/Addons/PhotoManagement/View/default/List.html');
    }

    function showPhoto() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('PhotoManagementController::showPhoto', $param);
        addWeixinLog('PhotoManagementController::showPhoto', I('name'));
        $map ['name'] = I('name');
        $data = M('photo_management')->where($map)->select();
        foreach ($data as &$c) {
            $this->assign('url', 'http://image.syue77.top/' . $c['name'] . '.jpg');
            $this->assign('shoutday', substr($c['name'], 0, 4) . '年' . substr($c['name'], 4, 2) . '月' . substr($c['name'], 6, 2) . '日' . substr($c['name'], 8, 2) . '时' . substr($c['name'], 10, 2) . '分');
            $this->assign('name', $c['name']);
            $this->assign('eflag', $c['flag']);
            $this->assign('ememo', $c['memo']);
            $this->assign('ehidden', $c['hidden']);
        }
        $type = I('type');
        $startDate = I('startDate');
        $endDate = I('endDate');
        $flag = I('flag');
        $memo = I('memo');
        $hidden = I('hidden');
        $page = I('page');

        $this->assign('type', $type);
        $this->assign('startDate', $startDate);
        $this->assign('endDate', $endDate);
        $this->assign('flag', $flag);
        $this->assign('hidden', $hidden);
        $this->assign('memo', $memo);
        $this->assign('page', $page);

        $this->display(SITE_PATH . '/Addons/PhotoManagement/View/default/Photo.html');
    }

    function editPhoto() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('PhotoManagementController::editPhoto', $param);
        $map ['name'] = I('name');
        $data = M('photo_management')->where($map)->select();
        foreach ($data as &$c) {
            $c['flag'] = I('eflag');
            $c['memo'] = I('ememo');
            $c['hidden'] = I('ehidden');
            $c['updateuser'] = $param ['openid'];
            $c['updatetime'] = time();
            M('photo_management')->where($map)->save($c);
        }
        
        $type = I('type');
        $startDate = I('startDate');
        $endDate = I('endDate');
        $flag = I('flag');
        $memo = I('memo');
        $hidden = I('hidden');
        $page = I('page');

        $param ['type'] = $type;
        $param ['startDate'] =  $startDate;
        $param ['endDate'] = $endDate;
        $param ['flag'] =  $flag;
        $param ['hidden'] =  $hidden;
        $param ['memo'] =  $memo;
        $param ['page'] =  $page;
        $param ['name'] = I('name');
        redirect(addons_url('PhotoManagement://PhotoManagement/showPhoto', $param));
    }

}
