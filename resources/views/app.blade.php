<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link  rel="stylesheet" href="/css/all.css">

</head>
<body>
	

	<div class="container">
		@include('partials.flash')


		@yield('content')
	</div>

	
    
    <script src="/js/all.js"></script>
	
	@yield('footer')

</body>
</html>
