<!DOCTYPE html>
<html>
<head>
<title>蘑菇街验证码</title>
<link rel="shortcut icon" href="/images/catalog/30avatardefault.jpg">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
</head>
<body>
<form id="captcha" action="" method="post">
	<a class="aim aim1" href="#"></a>
	<a class="aim aim2" href="#"></a>
	<a class="aim aim3" href="#"></a>
	<a class="aim aim4" href="#"></a>
	<input type="hidden" name="ckeck[]" id="input1" value="-1" />
	<input type="hidden" name="ckeck[]" id="input2" value="-1" />
	<input type="hidden" name="ckeck[]" id="input3" value="-1" />
	<input type="hidden" name="ckeck[]" id="input4" value="-1" />
	<input type="submit" name="submit" value="提交" />
</form>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#captcha a.aim').click(function(e){
		e.preventDefault();

		var index = $('#captcha a').index($(this)),
			m = parseInt( $('#captcha input').eq(index).val() ),
			_m = m>0 ? (m + 1) : 1,
			x,y,
			arr = [];
		
		if($.browser.msie){
			arr[0] = $(this).css("background-position-x");
			arr[1] = $(this).css("background-position-y");		
		}else{
			arr = $.trim( $(this).css("background-position").replace(/\s{2,}/ig, "")).split(" ");

		}

			
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
</script>
</body>
</html>