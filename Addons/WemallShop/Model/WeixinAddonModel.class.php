<?php
        	
namespace Addons\WemallShop\Model;
use Home\Model\WeixinModel;
        	
/**
 * WemallShop的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		// 其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();
		addWeixinLog ( 'WeixinAddonModel', $param );
		$url = addons_url ( 'WemallShop://WemallShop/show', $param );
		
		$articles [0] = array (
				'Title' => '网上商城',
				'Url' => $url 
		);
		
		$articles [0] ['Description'] = "网上商城";
		$articles [0] ['PicUrl'] = SITE_URL . '/Addons/WemallShop/View/default/Public/shop.jpg';
		addWeixinLog ( 'WeixinAddonModel', $articles );
		$this->replyNews ( $articles );
	}
}
        	