<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>朱迪调试蘑菇街＋投票</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="//cdn.bootcss.com/sweetalert/1.1.2/sweetalert.min.css" rel="stylesheet">
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
	.btn {
	line-height: 40px;
	cursor: pointer;
	-webkit-user-select: none;
	color: white;
	outline: none;
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
	#captcha .aim{display:inline-block;width:80px;height:80px;
	background-image:url({!!url('mgjimg')!!});
	background-repeat:no-repeat;
	}
	.aim1{background-position:0 0;}
	.aim2{background-position:-80px 0;}
	.aim3{background-position:-160px 0;}
	.aim4{background-position:-240px 0;}
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
		                             data-id="{{$article->photo}}" 	
						             class="btn btn-success zan">
						          <i class="glyphicon glyphicon-thumbs-up"></i>
					        </button>
		    </div>
		    <br>
		</article>	
		@endforeach
		<h1>{!!$articles->appends(Request::except('page'))->render()!!}</h1>
		</div>

        <div id="pop" class="hide">
            <form id="captcha" action="/mgjcheck" method="post">
				<a class="aim aim1" href="#"></a>
				<a class="aim aim2" href="#"></a>
				<a class="aim aim3" href="#"></a>
				<a class="aim aim4" href="#"></a>
				<input type="hidden" name="ckeck[]" id="input1" value="-1" />
				<input type="hidden" name="ckeck[]" id="input2" value="-1" />
				<input type="hidden" name="ckeck[]" id="input3" value="-1" />
				<input type="hidden" name="ckeck[]" id="input4" value="-1" />
				<input type="hidden" name='photopath' value=""/>
				<br>
				<button type="submit" class="btn btn-success">
						          提交</button>
			</form>
		</div>
	</div>   

<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/sweetalert/1.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
  
    $(document).ready(function (){
    	$('#captcha a.aim').click(function(e){
			e.preventDefault();
			var index = $('#captcha a').index($(this)),
				m = parseInt( $('#captcha input').eq(index).val() ),
				_m = m>0 ? (m + 1) : 1,
				x,y,
				arr = [];		
		
				arr = $.trim( $(this).css("background-position").replace(/\s{2,}/ig, "")).split(" ");

			x = parseInt( arr[0].replace("px", "") ),
			y = parseInt( arr[1].replace("px", "") );
			y = y-80 > -320 ? (y-80):0;
			$(this).css({
				"background-position": x + 'px ' + y + 'px'
			});
			$('#captcha input').eq(index).val(_m);
			return false;
		});
	});

	var popEle = document.getElementById("pop");
	var show = function(ele) {
	    ele.className = ele.className.replace("hide", "show");
	};
	var hide = function(ele) {
	    ele.className = ele.className.replace("show", "hide");
	};

	$('.zan').on("click",
	    function() {
		myBookId = $(this).data('id');
        $('input[name="photopath"]').val(myBookId);
	    show(popEle);
	});
	//隐藏＃pop
	popEle.addEventListener("click",
	function() {
	    hide(popEle);
	}); 
</script>
	@include('flash')
</body>
</html>