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
  <div class="container">  
          <div class="signin_top">
                <span class="signin_left">
                      <span class="signin_col"> <?php echo ($user["score"]); ?></span><br/>         
                      可用积分
                </span>
                <?php if(empty($has_log)): ?><a class="signintop_mid" onClick="doSign(0)">
                         签到
                </a>
                <?php else: ?>
                  <a class="signintop_mid" onClick="doSign(1)">
                         已签到
                </a><?php endif; ?>
               
                <span class="signintop_right">
                         <span class="signin_col"><?php echo ($day_count); ?></span><br/>             
                        签到次数
                </span>
           </div>
 
           <div class="i_nav">
                    <a href="<?php echo U('score_exchange');?>">
                           <img src="<?php echo ADDON_PUBLIC_PATH;?>/gift_white.png" width="26">
                           <br>
                           积分兑换
                    </a>
                    <span class="i_line"></span>
                    <a href="<?php echo U('sign_list');?>">
                            <img src="<?php echo ADDON_PUBLIC_PATH;?>/lists_white.png" width="26">
                            <br>
                            签到记录
                    </a>
                    <span class="i_line"></span>
                    <a href="<?php echo U('score_method');?>">
                            <img src="<?php echo ADDON_PUBLIC_PATH;?>/score_method.png" width="26">
                            <br>
                            积分攻略
                    </a>
           </div> 
   
           <div class="i_bpp">
                 <p class="i_leftp">
                   <a href="<?php echo addons_url('Card://Wap/signin');?>&year=<?php echo ($year); ?>&month=<?php echo ($month); ?>&next=1" class="上一月">&nbsp;<img src="<?php echo ADDON_PUBLIC_PATH;?>/i_left.png" height="30"></a>
                 </p>
                
                 <p class="i_midp">
                             <?php echo ($year); ?>年<?php echo ($month); ?>月
                 </p>
                 
                 <p class="i_rightp">
                     <a href="<?php echo addons_url('Card://Wap/signin');?>&year=<?php echo ($year); ?>&month=<?php echo ($month); ?>&next=2" class="下一月"><img src="<?php echo ADDON_PUBLIC_PATH;?>/i_right.png" height="30" />&nbsp;</a>
                 </p>
           </div>
            
            <div class="signin_table">
                <div id="calendar">
                  
                </div>
            </div>
         <nav class="bottom_nav">
            <a class="icon_me_gray" href="<?php echo addons_url('Card://Wap/me');?>">我的</a>
            <a class="icon_card_gray" href="<?php echo addons_url('Card://Wap/index');?>">会员卡</a>
            <a class="icon_notice_gray" href="<?php echo addons_url('Card://notice/show');?>">最新通知
             <?php if(!empty($notice_num)): ?><span class="red_circle"><?php echo ($notice_num); ?></span><?php endif; ?>
             <em></em>
            </a>
            <!--<a class="icon_ticket_gray" href="<?php echo addons_url('Card://coupons/show');?>">优惠券</a>-->
            <a class="icon_share_gray" href="<?php echo addons_url('Card://Wap/share');?>">分享</a>
            <a class="icon_signin_blue cur" href="<?php echo addons_url('Card://Wap/signin');?>">签到</a>
        </nav>
        <div class="bottom_nav_blank"></div>
 </div>
<script type="text/javascript" src="/weiphp/Public/static/jquery.calendar-widget.js"></script>
<script type="text/javascript">
var thelog = 0;
function doSign(log){
	
	if(log==1 || thelog ==1){
		var msg="<?php echo ($has_msg); ?>";
		if(msg != ""){
			$.Dialog.confirm('提示',msg);
		}
		return false;
	}
	$.Dialog.loading('正在签到...');
	var url="<?php echo addons_url('Card://Wap/do_signin');?>";
	$.post(url,function(data){
		if(data.status==1){
			thelog = 1;
			$.Dialog.confirm('提示',data.msg);
			setTimeout(function(){
				window.location.reload();
			},3500);
		}else{
			$.Dialog.confirm('提示',data.msg);
		}
	})
}
var sDay = '<?php echo ($mDays); ?>';
var sDayJson = new Array();
if(sDay!=''){
	sDayJson = JSON.parse(sDay);
}
$("#calendar").calendarWidget({
	month: <?php echo ($month); ?>-1,
	year: <?php echo ($year); ?>,
	signDays:sDayJson					  
});
</script>
</body>
</html>