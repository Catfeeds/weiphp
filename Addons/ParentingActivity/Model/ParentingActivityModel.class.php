<?php

namespace Addons\ParentingActivity\Model;
use Think\Model;

/**
 * ParentingActivity模型
 */
class ParentingActivityModel extends Model{
	function reply($dataArr, $keywordArr = array()) {
		// 其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();
		addWeixinLog ( ”ParentingActivityModel“, $param );
		$url = addons_url ( 'ParentingActivity://ParentingActivity/show', $param );
		
		$articles [0] = array (
				'Title' => '亲子游',
				'Url' => $url 
		);
		
		$articles [0] ['Description'] = ‘亲子游’;
		$articles [0] ['PicUrl'] = SITE_URL . '/Addons/ParentingActivity/View/default/Public/parent.jpg';
		addWeixinLog ( ”ParentingActivityModel“, $articles );
		$this->replyNews ( $articles );
	}

}
