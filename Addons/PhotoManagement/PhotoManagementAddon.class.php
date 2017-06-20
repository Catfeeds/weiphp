<?php

namespace Addons\PhotoManagement;
use Common\Controller\Addon;

/**
 * 照片管理插件
 * @author XIXI工作室
 */

    class PhotoManagementAddon extends Addon{

        public $info = array(
            'name'=>'PhotoManagement',
            'title'=>'照片管理',
            'description'=>'XIXI的照片',
            'status'=>1,
            'author'=>'XIXI工作室',
            'version'=>'0.1',
            'has_adminlist'=>0
        );

	public function install() {
		$install_sql = './Addons/PhotoManagement/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/PhotoManagement/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }