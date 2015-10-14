<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link  rel="stylesheet" href="/css/all.css">
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<title>好去处GoodGoTo</title>
</head>
<body>
	    @include('partials.nav')
	<div class="container page">
		@yield('content')
	</div> 
	<p id="back-to-top" ><a href="javascript:void(0)">回到顶部</a></p>
	        <script id="upvote-bookmark-template" type="x-template">
		    <li><button  type="button" 	
			         class="btn btn-default"	           
			         v-on="click: toggleLike"><strong>点赞</strong>
		    </button></li>
		    <li><button  type="button" 	
			         class="btn btn-default"
			         v-on="click: bookMark"><strong>书签</strong>           
		    </button></li>
		    </script>
    <script src="/js/all.js"></script>
    <script src="/js/main.js"></script>
	@yield('footer')
	@include('flash')
	</body>
</html>
