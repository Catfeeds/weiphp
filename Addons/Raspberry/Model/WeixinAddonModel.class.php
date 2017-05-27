<?php
        	
namespace Addons\Raspberry\Model;
use Home\Model\WeixinModel;
        	
/**
 * Raspberry的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		// 其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();
		addWeixinLog ( 'RaspberryModel', $param );
		$url = addons_url ( 'Raspberry://Raspberry/show', $param );
		
		$articles [0] = array (
				'Title' => '树莓派智能小车',
				'Url' => $url 
		);
		
		$articles [0] ['Description'] = "树莓派智能小车";
		$articles [0] ['PicUrl'] = SITE_URL . '/Addons/Raspberry/View/default/Public/58da658b05a87.jpg';
		addWeixinLog ( 'RaspberryModel', $articles );
		$this->replyNews ( $articles );
	}
}
        	