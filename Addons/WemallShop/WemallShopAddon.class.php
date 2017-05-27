<?php

namespace Addons\WemallShop;
use Common\Controller\Addon;

/**
 * 网上商城插件
 * @author 笑XIXI工作室
 */

    class WemallShopAddon extends Addon{

        public $info = array(
            'name'=>'WemallShop',
            'title'=>'网上商城',
            'description'=>'WeMall网上商城的跳转',
            'status'=>1,
            'author'=>'笑XIXI工作室',
            'version'=>'0.1',
            'has_adminlist'=>0
        );

	public function install() {
		$install_sql = './Addons/WemallShop/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/WemallShop/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }