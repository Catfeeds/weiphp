<?php

namespace Addons\XIXILovePinYin;
use Common\Controller\Addon;

/**
 * XIXI爱拼音插件
 * @author 爸爸
 */

    class XIXILovePinYinAddon extends Addon{

        public $info = array(
            'name'=>'XIXILovePinYin',
            'title'=>'XIXI爱拼音',
            'description'=>'帮助XIXI学拼音',
            'status'=>1,
            'author'=>'爸爸',
            'version'=>'0.1',
            'has_adminlist'=>0
        );

	public function install() {
		$install_sql = './Addons/XIXILovePinYin/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/XIXILovePinYin/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }