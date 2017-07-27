<?php

namespace Addons\TimeBank\Controller;

use Home\Controller\AddonsController;

class TimeBankController extends AddonsController {

    function _initialize() {
        parent::_initialize();
    }

    function show() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
//addWeixinLog('TimeBankController::show', $param);
        $map ['acount'] = 'XIXI';
        $map ['incommeExpense'] = 0;
        $data = M('time_bank')->where($map)->field("sum(amount) amount")->select();
        $in = intval($data [0] ['amount']);
        $map ['incommeExpense'] = 1;
        $data = M('time_bank')->where($map)->field("sum(amount) amount")->select();
        $out = intval($data [0] ['amount']);
        $balance = $in - $out;
        $this->assign('balance', $balance);

        $taget ['acount'] = 'XIXI';
        $taget ['status'] = '0';
        $tagetdata = M('time_deposit')->where($taget)->field("sum(time) time")->select();
        $this->assign('targetTime', intval($tagetdata [0] ['time']));
//addWeixinLog('TimeBankController::show', $tagetdata);
        $tagetAll = M('time_deposit')->where($taget)->field("sum(target) target")->select();
        $this->assign('targetAll', intval($tagetAll [0] ['target']));
//addWeixinLog('TimeBankController::show', $tagetAll);
        $editFlg = "0";
        if ($param ['token'] == "gh_20576134fc23" &&
                ($param ['openid'] == "ogMEps6tWx4w0fsB03i4Y7vJTjao" ||
                $param ['openid'] == "ogMEps2awMek2ThngULwDOMLc-W4")) {
            $editFlg = "1";
        }
        $this->assign('editFlg', $editFlg);
        $this->display(SITE_PATH . '/Addons/TimeBank/View/default/Show.html');
    }

    function help() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
//addWeixinLog('TimeBankController::help', $param);
        $this->display(SITE_PATH . '/Addons/TimeBank/View/default/help.html');
    }

    function detail() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
//addWeixinLog('TimeBankController::detail', $param);
        $page = I ( 'page', 1, 'intval' ); // 默认显示第一页数据
        $row = 6;
        $model = $this->getModel('time_bank');
        $map ['acount'] = 'XIXI';
        $cnt = M('time_bank')->where($map)->count ();
        if ($cnt % $row > 0 ) {
            $totalPages = intval($cnt / $row) + 1;
        } else {
            $totalPages = intval($cnt / $row);
        }
        $this->assign('totalPages', $totalPages);
        $this->assign('page', $page);
//addWeixinLog('TimeBankController::detail', $cnt);
//addWeixinLog('TimeBankController::detail', $totalPages);

        $data = M('time_bank')->where($map)->order('tradeDate desc')->page ( $page, $row )->select();
        foreach ($data as &$c) {
            $c['tradeDate'] = time_format($c['tradeDate'], 'Y-m-d');
            $c['incommeExpense'] = get_name_by_status($c['incommeExpense'], 'incommeExpense', $model['id']);
            $c['project'] = get_name_by_status($c['project'], 'project', $model['id']);
        }
        $this->assign('data', $data);
        $this->display(SITE_PATH . '/Addons/TimeBank/View/default/Detail.html');
    }
    
    function deposit() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
//addWeixinLog('TimeBankController::deposit', $param);
        $model = $this->getModel('time_deposit');
        $map ['acount'] = 'XIXI';
        $data = M('time_deposit')->where($map)->order('expiate')->select();
        foreach ($data as &$c) {
            $c['expiate'] = time_format($c['expiate'], 'Y-m-d');
            $c['status'] = get_name_by_status($c['status'], 'status', $model['id']);
        }
        $this->assign('data', $data);
        $this->display(SITE_PATH . '/Addons/TimeBank/View/default/Deposit.html');
    }

    function showAdd() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
//addWeixinLog('TimeBankController::showAdd', $param);
        $map ['acount'] = 'XIXI';
        $map ['status'] = '0';
        $data = M('time_deposit')->where($map)->order('id desc')->select();
        $this->assign('data', $data);
        $this->display(SITE_PATH . '/Addons/TimeBank/View/default/Add.html');
    }

    function addTime() {
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();
//addWeixinLog('TimeBankController::addTime', $param);
        if ($_POST['tradeDate'] != 0) {
            $map ['acount'] = 'XIXI';
            $map ['tradeDate'] = strtotime($_POST['tradeDate']);
            $map ['incommeExpense'] = $_POST['incommeExpense'];
            $map ['project'] = $_POST['project'];
            $map ['targetId'] = $_POST['targetId'];
            $map ['amount'] = $_POST['amount'];
            $map ['memo'] = $_POST['memo'];
            if ($param ['token'] == "gh_20576134fc23" &&
                    $param ['openid'] == "ogMEps6tWx4w0fsB03i4Y7vJTjao") {
                $map ['handlerName'] = '爸爸';
            } else if ($param ['token'] == "gh_20576134fc23" &&
                    $param ['openid'] == "ogMEps2awMek2ThngULwDOMLc-W4") {
                $map ['handlerName'] = '妈妈';
            }
            $map ['ceateTime'] = time();
            M('time_bank')->add($map);
            if ($map ['project'] == '5') {
                $target ['acount'] = 'XIXI';
                $target ['id'] = $map ['targetId'];
                $data = M('time_deposit')->where($target)->select();
//addWeixinLog('TimeBankController::showAdd', $target);
//addWeixinLog('TimeBankController::showAdd', $data);
                if (!empty($data)) {
//addWeixinLog('TimeBankController::showAdd', intval($data[0]['time']));
//addWeixinLog('TimeBankController::showAdd', intval($map ['amount']));
//addWeixinLog('TimeBankController::showAdd', intval($data[0]['time']) + intval($map ['amount']));
//addWeixinLog('TimeBankController::showAdd', $data['time']);
                    $data['time'] = strval(intval($data[0]['time']) + intval($map ['amount']));
//addWeixinLog('TimeBankController::showAdd', $data['time']);
                    M('time_deposit')->where ( $target )->save($data);
                }
            }
            unset($map);
        }
        redirect(addons_url('TimeBank://TimeBank/show', $param));
    }

    public function edit() {
        $model = $this->getModel('time_bank');
        $id = I('id');

        // 获取数据
        $data = M(get_table_name($model ['id']))->find($id);
        $data || $this->error('数据不存在！');

        if (IS_POST) {
            $Model = D(parse_name(get_table_name($model ['id']), 1));
            // 获取模型的字段信息
            $Model = $this->checkAttr($Model, $model ['id']);
            if ($Model->create() && $Model->save()) {
                $this->success('保存成功！', U('lists'));
            } else {
                $this->error($Model->getError());
            }
        } else {
            $fields = get_model_attribute($model ['id']);
            $this->assign('fields', $fields);
            $this->assign('data', $data);

            $this->display();
        }
    }

}
