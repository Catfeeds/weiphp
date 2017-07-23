<?php

namespace Addons\StudyMath\Controller;

use Home\Controller\AddonsController;

class StudyMathController extends AddonsController {

    function _initialize() {
        parent::_initialize();
    }

    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('StudyMathController::show', $param);
        $editFlg = "0";
        if ($param ['token'] == "gh_20576134fc23" &&
                ($param ['openid'] == "ogMEps6tWx4w0fsB03i4Y7vJTjao" ||
                $param ['openid'] == "ogMEps2awMek2ThngULwDOMLc-W4")) {
            $editFlg = "1";
        }
        $this->assign('editFlg', $editFlg);
        $this->display(SITE_PATH . '/Addons/StudyMath/View/default/Show.html');
    }
    
    function showList() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('StudyMathController::showList', $param);
        $nowDate = $_POST['studyDate'];
        addWeixinLog('StudyMathController::showList', $nowDate);
        $map ['studyDate'] = strtotime($nowDate);
        addWeixinLog('StudyMathController::showList', $map ['studyDate']);
        $data = M('study_math')->where($map)->select();
        $this->assign('data', $data);
        $this->assign('nowDate', $nowDate);
        $this->display(SITE_PATH . '/Addons/StudyMath/View/default/List.html');
    }
    
    function addList() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
        addWeixinLog('StudyMathController::addList', $param);
        $nowDate = $_POST['studyDate'];
        $map ['studyDate'] = strtotime($nowDate);
        $cnt = M('study_math')->where($map)->count();
        if ($cnt == 0) {
            $questions = M('math_questions')->limit ( 21 )->order('RAND()')->select();
            foreach ( $questions as $vo ) {
                $studyMath['studyDate'] = strtotime($nowDate);
                $studyMath['studyContent'] = $vo['content'];
                M('study_math')->add($studyMath);
            }
        }
        $data = M('study_math')->where($map)->select();
        $this->assign('data', $data);
        $this->assign('nowDate', $nowDate);
        $this->display(SITE_PATH . '/Addons/StudyMath/View/default/List.html');
    }

}
