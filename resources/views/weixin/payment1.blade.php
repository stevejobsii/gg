<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付样例</title>
    <style type="text/css">
        ul {
            margin-left:10px;
            margin-right:10px;
            margin-top:10px;
            padding: 0;
        }
        li {
            width: 32%;
            float: left;
            margin: 0px;
            margin-left:1%;
            padding: 0px;
            height: 100px;
            display: inline;
            line-height: 100px;
            color: #fff;
            font-size: x-large;
            word-break:break-all;
            word-wrap : break-word;
            margin-bottom: 5px;
        }
        a {
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:link{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:visited{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:hover{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
        a:active{
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        	text-decoration:none;
            color:#fff;
        }
    </style>
</head>
<body>
	<div align="center">
        <ul>
            <li style="background-color:#FF7F24">
            	<button type="button" onclick="WXPayment()">
				    支付 ￥<?php echo ($order->total_fee / 100); ?> 元
				</button>
            </li>
        </ul>
	</div>
<script type="text/javascript"src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
wx.config(<?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo','onMenuShareAppMessage',), true) ?>);

		function onBridgeReady(){
		WeixinJSBridge.invoke(
		       'getBrandWCPayRequest', {
		           "appId" ： "wx2421b1c4370ec43b",     //公众号名称，由商户传入     
		           "timeStamp"：" 1395712654",         //时间戳，自1970年以来的秒数     
		           "nonceStr" ： "e61463f8efa94090b1f366cccfbbb444", //随机串     
		           "package" ： "prepay_id=u802345jgfjsdfgsdg888",     
		           "signType" ： "MD5",         //微信签名方式：     
		           "paySign" ： "70EA570631E4BB79628FBCA90534C63FF7FADD89" //微信签名 
		       },
		       function(res){     
		           if(res.err_msg == "get_brand_wcpay_request：ok" ) {}     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。 
		       }
		   ); 
		}
		if (typeof WeixinJSBridge == "undefined"){
		   if( document.addEventListener ){
		       document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
		   }else if (document.attachEvent){
		       document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
		       document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
		   }
		}else{
		   onBridgeReady();
		}
</script>
</body>
</html>
