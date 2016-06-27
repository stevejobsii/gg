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
	<div align="center" id="vue_app" class = 'zan'>
        <ul>
            <li  style="background-color:#FF7F24">
                玫瑰油
                <button class="setattributes" data-id="roseoil">玫瑰油¥0.01一瓶
                </button>
            </li>
            <li  style="background-color:#698B22">
                山苍紫
                <button class="setattributes" data-id="csoil">山苍紫¥0.02一瓶
                </button>
            </li>
            <li  style="background-color:#8B6914">
                沉香油
                <button class="setattributes" data-id="xcoil">沉香油¥0.03一瓶
                </button>
            </li>
        </ul>
	</div>


<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">


    $('.setattributes').on("click", function () {
        var itemId = $(this).data('id');
        var pathname = window.location.hostname;
        var urll = 'https://'+pathname+'/weixin/setattributes';
            $.ajax({
              method: "POST",
              url: urll,
              data:{'body':itemId}
            })
            .done(function( json ) {
                alert(json);
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',json,
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
            });
    });
</script>
</body>
</html>
