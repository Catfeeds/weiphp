<?php
        	
namespace Addons\parentingActivity\Model;
use Home\Model\WeixinModel;
        	
/**
 * parentingActivity的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'parentingActivity' ); // 获取后台插件的配置参数	
		//dump($config);
	}
}
        	