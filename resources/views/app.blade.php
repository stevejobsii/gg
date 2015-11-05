<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta name="keywords" content="无厘头 搞笑 幽默 好去处 goodgoto 游戏 女性 恶搞 gif 笑笑小电影">
    <meta name="baidu_union_verify" content="3c05d5a3879ebffd964063aada5f8721">
	<link rel="stylesheet" href="/css/all.css">
	<link rel="stylesheet" href="/css/main.css">
    <link rel="shortcut icon" href="/images/catalog/goodgotologo.jpg">
    <title>GoodGoto好去处</title>
    <script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?0e017dd4be7147b6bbbf67e79b2ae93f";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
</head>
   
<body data-spy="scroll" data-target="#myScrollspy" data-offset="70">
	    @include('partials.nav')
	<div class="container page">
		@yield('content')
	</div> 
	<p id="back-to-top" ><a href="javascript:void(0)">回到顶部</a></p>
    <script src="/js/all.js"></script>
	@yield('footer')
	@yield('js')
	@include('flash')
	</body>
</html>
