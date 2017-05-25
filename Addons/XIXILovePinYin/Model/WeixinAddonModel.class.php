<?php
	
namespace Addons\XIXILovePinYin\Model;

use Home\Model\WeixinModel;
        	
/**
 * XIXILovePinYin的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		// 其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();
		addWeixinLog ( ”WeixinAddonModel“, $param );
		$url = addons_url ( 'XIXILovePinYin://PinYin/show', $param );
		
		$articles [0] = array (
				'Title' => 'XIX爱拼音',
				'Url' => $url 
		);
		
		$articles [0] ['Description'] = ‘爱拼音’;
		$articles [0] ['PicUrl'] = SITE_URL . '/Addons/XIXILovePinYin/View/default/Public/pinyin_pic.jpg';
		addWeixinLog ( ”WeixinAddonModel“, $articles );
		$this->replyNews ( $articles );
	}
}
