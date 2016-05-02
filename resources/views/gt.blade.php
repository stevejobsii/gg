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
				<script src="https://static.geetest.com/static/tools/gt.js"></script>
				<script>
				$(document).ready(function (){
				    $.ajaxSetup({
				        headers: { 'X-CSRF-TOKEN': $('meta[name="token"]').attr('value') }
				    });
				});
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
			    var handler = function (captchaObj) {
				         // 将验证码加到id为captcha的元素里
				         captchaObj.appendTo("#captcha");
				     };
				    $.ajax({
				        // 获取id，challenge，success（是否启用failback）
				        url: "gt1?rand="+Math.round(Math.random()*100),
				        type: "get",
				        dataType: "json", // 使用jsonp格式
				        success: function (data) {
				            // 使用initGeetest接口
				            // 参数1：配置参数，与创建Geetest实例时接受的参数一致
				            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
				            initGeetest({
				                gt: data.gt,
				                challenge: data.challenge,
				                product: "embed", // 产品形式
				                offline: !data.success
				                //更多前端参数配置 http://www.geetest.com/install/sections/idx-client-sdk.html#config-para
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
								            validate(o)		            
								        });
				            });
				        }
				    });
				    var validate = function(captcha) {
					    var values = captcha.getValidate();
					    var query = "geetest_challenge=" + values.geetest_challenge + "&geetest_validate=" + values.geetest_validate + "&geetest_seccode=" + values.geetest_seccode + "&callback=handlerResult";
					    $.ajax({
					      method: "POST",
					      url: "https://goodgoto.com/gt2?" + query,
					      })
					     .done(function(result) {
			                if (result === "Yes!") {
			                    $.ajax({
							      method: "POST",
							      url: urll,
							    })
							    .done(function( vote_count ) {
							     $('#'+'b'+myBookId).text(vote_count);
							    });
							    hide(popEle);
			                }else{
			                	o.refresh();
			                }
				        });			   
					};
                    //点击点赞按钮
					$('.login').on("click",
					function() {
						window.myBookId = $(this).data('id');
					    window.pathname = window.location.hostname;
						window.urll = 'https://'+pathname+'/gt/'+myBookId+'/upvote';
						if (o) {
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
					

		</div>
	</div>
</body>
</html>