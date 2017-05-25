<?php

namespace Addons\ParentingActivity;
use Common\Controller\Addon;

/**
 * 亲子游插件
 * @author 笑XIXI工作室
 */

    class ParentingActivityAddon extends Addon{

        public $info = array(
            'name'=>'ParentingActivity',
            'title'=>'亲子游',
            'description'=>'亲子游',
            'status'=>1,
            'author'=>'笑XIXI工作室',
            'version'=>'0.1',
            'has_adminlist'=>0
        );

	public function install() {
		$install_sql = './Addons/ParentingActivity/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/ParentingActivity/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }