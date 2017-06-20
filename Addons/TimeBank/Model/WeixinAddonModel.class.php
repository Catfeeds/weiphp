<?php
        	
namespace Addons\TimeBank\Model;
use Home\Model\WeixinModel;
        	
/**
 * TimeBank的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		// 其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();
		addWeixinLog ( 'TimeBank', $param );
		$url = addons_url ( 'TimeBank://TimeBank/show', $param );
		
		$articles [0] = array (
				'Title' => '时间银行',
				'Url' => $url 
		);
		
		$articles [0] ['Description'] = "时间银行";
		$articles [0] ['PicUrl'] = SITE_URL . '/Addons/TimeBank/View/default/Public/img/pic.gif';
		addWeixinLog ( 'TimeBankModel', $articles );
		$this->replyNews ( $articles );
	}
}
        	