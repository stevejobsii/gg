@extends('app')

@section('content')


	<ul class="list">
	@foreach($articles as $article)
		<li class="list-item" id={{$article->id}}   style="margin-top: 0px;">
			<a href="{{ action('ArticlesController@show', [$article->id])}}" ><h2>{{$article->title}}</h2></a>
            
            <a href="{{ action('ArticlesController@show', [$article->id])}}" >
            <img src="/images/catalog/{{$article->photo}}" alt="{{$article->title}}">
			</a>
			<br>
			<button  
			         type="button" 	
			         v-class="active: liked"		           
			         v-on="click: toggleLike">
            <span class="glyphicon glyphicon-thumbs-up">
            </span>
            </button>
            <span id="b{{$article->id}}">points{{$article->vote_count}} </span>个赞
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
			<span> • </span>已有{{$article->reply_count}}评论
			<span> • </span>{{$article->view_count}}人阅读
			</a>
		</li>	
		<hr>
	@endforeach
    <ul>
@stop