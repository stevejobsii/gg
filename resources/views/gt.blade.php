<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
     <meta id="token" name="token" value="{{ csrf_token() }}">
     <link rel="stylesheet" href="{{ url('/css/all.css') }}">
     <script src="/js/all.js"></script>
     <script src="http://static.geetest.com/static/tools/gt.js"></script>
     <script>
		var handler = function (captchaObj) {
		         captchaObj.appendTo("#captcha");
		     };
		    $.ajax({
		        url: "../gt1?rand="+Math.round(Math.random()*100),
		        type: "get",
		        dataType: "json", 
		        success: function (data) {
		            initGeetest({
		                gt: data.gt,
		                challenge: data.challenge,
		                product: "embed",
		                offline: !data.success
		            }, function(obj) {
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
                                                  alert('1');
							                } else {
							                    o.refresh();
							                }
							            });
							        });
							    });
		        }
		    });
	</script>
	<title>朱迪调试滑动验证＋投票</title>
</head>
<body>
	<style type="text/css">
	    .show {
		display: block;
		}
		.hide {
		display: none;
		}
        .wrap{
            width:100%;
        }
		.container{
			width: 960px;
			margin: 0 auto;
		}
		.box{
			width:300px;
			margin: 30px auto; 
		}
		.header{
			margin: 80px auto 30px auto;
			text-align: center;
			font-size: 34px;
		}
		ul{
			list-style-type: none;
		}
		.glyphicon{
			font-size: 60px;
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
	</style>

	<div class="container">
		<div class="header">
			朱迪调试滑动验证＋投票
		</div>
		<div class="header">

		@foreach($articles as $article)
		<article>
		    <div class="col-md-12 col-sm-12 col-xs-12">
	            <h1 class="index-article-title">{!!$article->title!!}共<span id="b{{$article->photo}}">{!!$article->vote_count!!}</span>赞</h1>		
				    <form method="post" action="../gt/{{$article->photo}}/upvote">
				        <input type="hidden" name="_token" value="{!! csrf_token() !!}">	                    
	                    <button  	type="button"  id="vote" 	
					             class="btn btn-defaul">
					          <i class="glyphicon glyphicon-thumbs-up"></i>
				        </button>

                        <button type="submit" class="btn btn-primary hidden" id="submit">更新</button>
			

			            <div id="pop" class="hide" >
					    	<div id="captcha"></div>
					    </div>
				    </form>
		    </div>
		    <br>
		</article>	
		@endforeach
		</div>
	</div>   

         	
            <script>	
		            var show = function(ele) {
					    ele.className = ele.className.replace("hide", "show");
					};
					var hide = function(ele) {
					    ele.className = ele.className.replace("show", "hide");
					};
	            	var popEle = document.getElementById("pop");
	            	var voteBtn = document.getElementById("vote");
	            	voteBtn.addEventListener("click",
					function() {
					    show(popEle);
					});
                    popEle.addEventListener("click",
					function() {
					    hide(popEle);
					}); 



					var validate = function(captcha, cb) {
					    var values = captcha.getValidate();
					    var query = "geetest_challenge=" + values.geetest_challenge + "&geetest_validate=" + values.geetest_validate + "&geetest_seccode=" + values.geetest_seccode + "&callback=handlerResult";
					    var script = document.createElement("script");
					    script.src = "http://ggg.local/gt2?" + query;
					    script.charset = "utf-8";
					    document.body.appendChild(script);
					    window.handlerResult = cb;
					};

		            // $('#pop').change(function () {
		            // $('#submit').click();
		            // });
            </script>
</body>
</html>