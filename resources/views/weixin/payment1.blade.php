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
            	<button type="button" id="onclickpay">
				    支付 ￥<?php echo ($order->total_fee / 100); ?> 元
				</button>
            </li>
        </ul>
	</div>
<script type="text/javascript">
document.querySelector('#onclickpay').onclick = function () {
    WeixinJSBridge.invoke(
        'getBrandWCPayRequest', <?= $json ?>,
        function(res){     
           switch(res.err_msg) {
                case 'get_brand_wcpay_request:cancel':
                    alert('用户取消支付！');
                    break;
                case 'get_brand_wcpay_request:fail':
                    alert('支付失败！（'+res.err_desc+'）');
                    break;
                case 'get_brand_wcpay_request:ok':
                    alert('支付成功！');
                    break;
                default:
                    alert(JSON.stringify(res));
                    break;
            } 
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
