@extends('app')

@section('content')


	<hr>
	@foreach($articles as $article)
		<li class="list" id={{$article->id}} style="margin-top: 0px;">
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank"><h2>{{$article->title}}</h2></a>
            <a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
            <img src="/images/catalog/{{$article->photo}}">
			</a> 
			<br>
			<button  type="button" 
			         v-class="active: liked"  
			         v-on="click: toggleLike">
            <span class="glyphicon glyphicon-thumbs-up">
            </span>
            </button>
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
			已有{{ $article->vote_count }}个赞
			<span> • </span>已有{{$article->reply_count}}评论
			<span> • </span>{{$article->view_count}}人阅读
			</a>
		</li>	
		<hr>
	@endforeach

@stop