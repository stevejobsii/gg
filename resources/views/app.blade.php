<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta property="qc:admins" content="4457261067477476375" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>goodgoto</title>
	<link  rel="stylesheet" href="/css/all.css">
</head>
<body>
	    @include('partials.nav')
	<div class="container">
		@include('partials.flash')
		@yield('content')
	</div>   
	<script src="/js/jquery.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
	  @yield('footer')
</body>
</html>
