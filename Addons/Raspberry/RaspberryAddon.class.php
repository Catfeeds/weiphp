<?php

namespace Addons\Raspberry;
use Common\Controller\Addon;

/**
 * 树莓派智能小车插件
 * @author 笑XIXI工作室
 */

    class RaspberryAddon extends Addon{

        public $info = array(
            'name'=>'Raspberry',
            'title'=>'树莓派智能小车',
            'description'=>'树莓派智能小车应用',
            'status'=>1,
            'author'=>'笑XIXI工作室',
            'version'=>'0.1',
            'has_adminlist'=>0
        );

	public function install() {
		$install_sql = './Addons/Raspberry/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Raspberry/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }