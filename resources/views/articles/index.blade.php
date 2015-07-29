@extends('app')

@section('content')

	<h1>文章</h1>
	<hr>

	@foreach($articles as $article)
		<article>
			<h2><a href="{{ action('ArticlesController@show', [$article->id])}}">{{$article->title}}</a></h2>
				<img src="/images/catalog/{{$article->photo}}">
		</article>	
	@endforeach

@stop