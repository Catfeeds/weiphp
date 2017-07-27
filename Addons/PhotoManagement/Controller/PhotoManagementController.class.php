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
        addWeixinLog('PhotoManagementController', $param);
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
        
     
        if (!empty($startDate) && !empty($endDate)) {
            $startDate = str_replace('-','',$startDate) . '000000';
            $endDate = str_replace('-','',$endDate) . '235959';
            $map['name'] = array('between', array($startDate, $endDate));
        } else if (!empty($startDate)) {
            $startDate = str_replace('-','',$startDate) . '000000';
            $map['name'] = array('egt', $startDate);
        } else if (!empty($endDate)) {
            $endDate = str_replace('-','',$endDate) . '235959';
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
            $c['name'] = 'http://image.syue77.top/' . $c['name'] . '.jpg?imageView2/1/w/100/h/100';
        }
        $this->assign('data', $data);

        $this->display(SITE_PATH . '/Addons/PhotoManagement/View/default/List.html');
    }

    function showPhoto() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('StudyMathController::showList', $param);
        $nowDate = I('studyDate');
        $map ['studyDate'] = strtotime($nowDate);
        $data = M('study_math')->where($map)->select();

        $this->assign('data', $data);
        $this->assign('nowDate', $nowDate);

        $this->display(SITE_PATH . '/Addons/PhotoManagement/View/default/List.html');
    }

}
