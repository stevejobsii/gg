<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta name="keywords" content="无厘头 搞笑 幽默 好去处 goodgoto 游戏 女性 恶搞 gif 笑笑小电影">
	<link rel="stylesheet" href="{{ url('/css/all.css') }}">
	<link rel="stylesheet" href="{{ url('/css/main.css') }}">
    <link rel="shortcut icon" href="/images/catalog/30avatardefault.jpg">
    <meta property="qc:admins" content="4457261067477476375" />
    <title>好去处 - Just For Fun</title>

</head>
   
<body data-spy="scroll" data-target="#myScrollspy" data-offset="70">
	    @include('partials.nav')
	<div class="container page">
		@yield('content')
	</div> 
	<p id="back-to-top" ><a href="javascript:void(0)"></a></p>
	<div id="qq-connect"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=401789679&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:401789679:53" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></div>
    <script src="/js/all.js"></script>
	@include('footer')
	@include('flash')
	@yield('js')
</body>
</html>
