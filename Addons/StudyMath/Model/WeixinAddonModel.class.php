<?php
        	
namespace Addons\StudyMath\Model;
use Home\Model\WeixinModel;
        	
/**
 * StudyMath的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		// 其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();
		addWeixinLog ( 'StudyMath', $param );
		$url = addons_url ( 'StudyMath://StudyMath/show', $param );
		
		$articles [0] = array (
				'Title' => '数学',
				'Url' => $url 
		);
		
		$articles [0] ['Description'] = "今日数学";
		$articles [0] ['PicUrl'] = SITE_URL . '/Addons/StudyMath/View/default/Public/img/pic.jpg';
		addWeixinLog ( 'StudyMathModel', $articles );
		$this->replyNews ( $articles );
	}
}
        	