<?php

namespace Addons\TimeBank\Model;

use Think\Model;

/**
 * TimeBank模型
 */
class TimeBankModel extends Model {

    function getInfo($id, $update = false, $data = array()) {
        $key = 'TimeBank_getInfo_' . $id;
        $info = S($key);
        if ($info === false || $update) {
            $info = (array) (empty($data) ? $this->find($id) : $data);
            S($key, $info, 86400);
        }
        return $info;
    }

    function getBalance() {
        $map ['acount'] = 'XIXI';
        $number = $this->where($map)->field('max(id) as num, balance')->select();
        return intval($number [0] ['balance']) + 1;
    }

    function save($save = array()) {
        $res = $this->save($save);
        return $res;
    }

}
