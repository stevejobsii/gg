@extends('app')

@section('content')

	<h1>文章</h1>
	<hr>

	@foreach($articles as $article)
		<li class="list-group-item media" style="margin-top: 0px;">
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank"><h2>{{$article->title}}</h2></a>
            <a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
            <img src="/images/catalog/{{$article->photo}}">
			</a> 
			<br>
			已有{{ $article->vote_count }}个赞
			
		</li>	
	@endforeach

@stop