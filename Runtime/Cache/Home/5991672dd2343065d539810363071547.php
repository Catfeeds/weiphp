<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="stylesheet" type="text/css" href="/weiphp/Public/Home/css/mobile_module.css?v=<?php echo SITE_VERSION;?>" media="all">
    <script type="text/javascript">
		//静态变量
		var SITE_URL = "<?php echo SITE_URL;?>";
		var IMG_PATH = "/weiphp/Public/Home/images";
		var STATIC_PATH = "/weiphp/Public/static";
		var WX_APPID = "<?php echo ($jsapiParams["appId"]); ?>";
		var	WXJS_TIMESTAMP='<?php echo ($jsapiParams["timestamp"]); ?>'; 
		var NONCESTR= '<?php echo ($jsapiParams["nonceStr"]); ?>'; 
		var SIGNATURE= '<?php echo ($jsapiParams["signature"]); ?>';
	</script>
    <script type="text/javascript" src="/weiphp/Public/static/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript" src="minify.php?f=/weiphp/Public/Home/js/prefixfree.min.js,/weiphp/Public/Home/js/m/dialog.js,/weiphp/Public/Home/js/m/flipsnap.min.js,/weiphp/Public/Home/js/m/mobile_module.js&v=<?php echo SITE_VERSION;?>"></script>
</head>	
<link href="<?php echo ADDON_PUBLIC_PATH;?>/card.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">

<body>
	<div id="container" class="container body">
    	<!--
    	<div class="common_header">
        	<a class="back" href="javascript:;" onClick="history.back()"></a>
            <span>最新通知</span>
        </div>
        -->
        <ul class="toggle_list" style="margin-top:10px">
        <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="single_item m_15 p_10">
            	<div class="title icon_arrow_right">
                	<img width="30" class="fl mr_10" src="<?php echo ADDON_PUBLIC_PATH;?>/notice.png"/>
                	<p class="t_color"><strong><?php echo ($vo["title"]); ?> 
                		<?php  ?>
                	</strong></p>
                </div>
                <div class="content" style="margin-top:0">
                <p class="colorless">发布时间：<?php echo (time_format($vo["cTime"])); ?></p>
                	<p><?php echo (htmlspecialchars_decode($vo["content"])); ?></p>
                </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>   	
        <?php if(empty($list)): ?><div class="empty_default">
            	<br/><br/>
            	<p><img src="/weiphp/Public/Home/images/empty_content.png"/><br/>会员卡目前还没通知~</p>
            </div><?php endif; ?>
        <p class="copyright"><?php echo ($system_copy_right); ?></p>
         <nav class="bottom_nav">
            <a class="icon_me_gray" href="<?php echo addons_url('Card://Wap/me');?>">我的</a>
            <a class="icon_card_gray" href="<?php echo addons_url('Card://Wap/index');?>">会员卡</a>
            <a class="icon_notice_blue cur" href="<?php echo addons_url('Card://notice/show');?>">最新通知</a>
            <!--<a class="icon_ticket_gray" href="<?php echo addons_url('Card://coupons/show');?>">优惠券</a>-->
        <a class="icon_share_gray" href="<?php echo addons_url('Card://Wap/share');?>">分享</a>
        <a class="icon_signin_gray" href="<?php echo addons_url('Card://Wap/signin');?>">签到</a>
        </nav>     
    </div>
</body>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
});
</script>
</html>