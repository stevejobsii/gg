<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>朱迪调试滑动验证＋投票</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta id="token" name="token" value="{{ csrf_token() }}">
<link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<style>
* {
box-sizing: border-box;
}
body {
text-align: center;
padding-bottom: 40px;
margin: 0;
font-family: "Microsoft YaHei", sans-serif;
}
.show {
display: block;
}
.hide {
display: none;
}
.green {
color: #31B567;
}
.bg-cyan {
background-color:#72C47C ;
border-radius: 2px;
}
.try{
text-decoration: none;
color:white;
margin: 15px auto;
height: 40px;
width: 260px;
overflow: hidden;
display: inline-block;
}
.font-28 {
font-size: 28px;
}
.font-15 {
font-size: 15px;
}
.font-14 {
font-size: 14px;
}
.font-16 {
font-size: 16px;
}
.btn {
line-height: 40px;
cursor: pointer;
-webkit-user-select: none;
color: white;
outline: none;
}
.fields {
margin-bottom: 30px;
}
.fields>div
{
margin: 15px auto;
height: 40px;
width: 260px;
overflow: hidden;
}
.fields>.user,
.fields>.password {
border: 1px solid #BBBBBB;
padding: 5px 0 5px 35px;
background-repeat: no-repeat;
background-position: 9px 50%;
background-size: auto 20px;
text-align: left;
}
.title {
margin-bottom: 40px;
}
.title>h1 {
margin: 0;
}
.title>p {
margin: 5px 0 0 0;
}
#pop {
position: fixed;
left: 0;
top: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.5);
text-align: center;
overflow: auto;
}
.gt_mobile_holder {
margin-top: 100px;
display: inline-block;
}
</style>
</head>
<body>



    <div class="container">
		<div class="header">
			朱迪调试滑动验证＋投票
		</div>
		<div class="header">

		@foreach($articles as $article)
		<article>
		    <div class="col-md-12 col-sm-12 col-xs-12">
	            <h1 class="index-article-title">{!!$article->title!!}    共<span id="b{{$article->photo}}">{!!$article->vote_count!!}</span>赞</h1>			

		                    <button  	type="button"  	
						             class="btn btn-primary login"
						             data-id="{{$article->photo}}"
				                     data-title="{{$article->title}}">
						          <i class="glyphicon glyphicon-thumbs-up"></i>
					        </button>

		   
		    </div>
		    <br>
		</article>	
		@endforeach
		<h1>{!!$articles->appends(Request::except('page'))->render()!!}</h1>
		</div>

        <div id="pop" class="hide">
		    	<div id="captcha"></div>
		</div>
	</div>   



<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
$(document).ready(function (){
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="token"]').attr('value') }
    });
});
	// alert(document.documentElement.clientWidth);
	var initGeetest = (function(window, document) {
	    var random = function() {
	        return parseInt(Math.random() * 10000) + (new Date()).valueOf();
	    };
	    var callbacks = [];
	    var status = "loading";
	    // 加载Geetest库
	    var cb = "geetest_" + random();
	    window[cb] = function() {
	        status = "loaded";
	        window[cb] = undefined;
	        try {
	            delete window[cb];
	        } catch(e) {}
	        for (var i = 0,
	        len = callbacks.length; i < len; i = i + 1) {
	            callbacks[i]();
	        }
	    };
	    var s = document.createElement("script");
	    s.onerror = function() {
	        status = "fail";
	        for (var i = 0,
	        len = callbacks.length; i < len; i = i + 1) {
	            callbacks[i]();
	        }
	    };
	    s.src = (location.protocol === "https:" ? "https:": "http:") + "//api.geetest.com/get.php?callback=" + cb;
	    document.getElementsByTagName("head")[0].appendChild(s);
	    return function(config, callback) {
	        var protocol = config.https ? "https://": "http://";
	        var initGeetest = function() {
	            callback(new window.Geetest(config));
	        };
	        var backendDown = function() {
	            var s = document.createElement("script");
	            s.id = "gt_lib";
	            s.src = protocol + "static.geetest.com/js/geetest.0.0.0.js";
	            s.charset = "UTF-8";
	            s.type = "text/javascript";
	            head.appendChild(s);
	            s.onload = s.onreadystatechange = function() {
	                if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
	                    initGeetest();
	                    s.onload = s.onreadystatechange = null;
	                }
	            };
	        };
	        if (status === "loaded") {
	            // Geetest对象已经存在，则直接初始化
	            initGeetest();
	        } else if (status === "fail") {
	            // 无法动态获取Geetest库，则去获取geetest.0.0.0.js
	            backendDown();
	        } else if (status === "loading") {
	            // 之前已经去加载Geetest库了，将回调加入callbacks，等Geetest库好后去回调
	            callbacks.push(function() {
	                if (status === "fail") {
	                    backendDown();
	                } else {
	                    initGeetest();
	                }
	            });
	        } else {}
	    };
	} (window, document));
	var tasteEle = document.getElementById("taste");
	var popEle = document.getElementById("pop");
	//var successEle = document.getElementById("success");
	//var loginBtn = document.getElementById("login");
	var show = function(ele) {
	    ele.className = ele.className.replace("hide", "show");
	};
	var hide = function(ele) {
	    ele.className = ele.className.replace("show", "hide");
	};
	window.init = function(config) {
	    console.log(config);
	    initGeetest({
	        gt: config.gt,
	        challenge: config.challenge,
	        product: "embed",
	        width: "301px",
	        offline: !config.success
	    },
	    function(obj) {
	        window.o = obj;
	        o.appendTo("#pop");
	        o.onReady(function() {
	            popEle.firstChild.addEventListener("click",
	            function(e) {
	                e.stopPropagation();
	            });
	        });
	        o.onSuccess(function() {
	            validate(o,
	            function(result) {
	                if (result === "success") {
	                    $.ajax({
					      method: "POST",
					      url: urll,
					    })
					    .done(function( vote_count ) {
					     $('#'+'b'+myBookId).text(vote_count);
					    });
					    hide(popEle);
	                } else {
	                    o.refresh();
	                }
	            });
	        });
	    });
	};	
	var validate = function(captcha, cb) {
	    var values = captcha.getValidate();
	    var query = "geetest_challenge=" + values.geetest_challenge + "&geetest_validate=" + values.geetest_validate + "&geetest_seccode=" + values.geetest_seccode + "&callback=handlerResult";
	    var script = document.createElement("script");
	    script.src = "https://webapi.geetest.com/apis/mobile-server-validate/?" + query;
	    script.charset = "utf-8";
	    document.body.appendChild(script);
	    window.handlerResult = cb;
	};

	var script = document.createElement("script");
	script.src = "https://webapi.geetest.com/apis/start-mobile-captcha/?callback=init";
	script.charset = "utf-8";
	document.body.appendChild(script);
	//点击点赞按钮
	$('.login').on("click",
	function() {
		 window.myBookId = $(this).data('id');
		 window.pathname = window.location.hostname;
		 window.urll = 'http://'+pathname+'/gt/'+myBookId+'/upvote';
	    if (typeof o != "undefined") {
	        o.refresh();
	    }
	    //alert(urll);
	    show(popEle);
	});
	//隐藏＃pop
	popEle.addEventListener("click",
	function() {
	    hide(popEle);
	}); 
</script>
</body>
</html>
