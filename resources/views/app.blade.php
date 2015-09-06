<!DOCTYPE html>
<html lang="en" xmlns:wb="http://open.weibo.com/wb">
<head>
	<meta charset="utf-8">
	<meta property="qc:admins" content="4457261067477476375" />
	<meta property="wb:webmaster" content="55004ec0cf08115a" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link  rel="stylesheet" href="/css/all.css">
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=27813139" type="text/javascript" charset="utf-8"></script>
	<title>好去处GoodGoTo</title>
</head>
<body>
	    @include('partials.nav')
	<div class="container page">
		@yield('content')
	</div>   
	<script src="/js/jquery.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
	@yield('footer')
	@include('flash')
	</body>
</html>
