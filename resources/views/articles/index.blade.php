@extends('app')

@section('content')


	<hr>

	@foreach($articles as $article)
		<li class="list-group-item media" style="margin-top: 0px;">
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank"><h2>{{$article->title}}</h2></a>
            <a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
            <img src="/images/catalog/{{$article->photo}}">
			</a> 
			<br>
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
			已有{{ $article->vote_count }}个赞
			<span> • </span>已有{{$article->reply_count}}评论
			</a>
   
		</li>	
	@endforeach

@stop