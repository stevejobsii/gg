<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="//cdn.bootcss.com/sweetalert/1.1.0/sweetalert.min.css" rel="stylesheet">
	<link  rel="stylesheet" href="/css/main.css">
	<meta id="token" name="token" value="{{ csrf_token() }}">

	<title>好去处GoodGoTo</title>
</head>
<body>
	    @include('partials.nav')
	<div class="container page">
		@yield('content')
	</div> 
	<p id="back-to-top" ><a href="javascript:void(0)">回到顶部</a></p>

		    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
		    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		    <script src="//cdn.bootcss.com/sweetalert/1.1.0/sweetalert.min.js"></script>
            <script src="/js/main.js"></script>
	@yield('footer')
	@yield('js')
	@include('flash')
	</body>
</html>
