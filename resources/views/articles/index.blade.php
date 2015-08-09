@extends('app')

@section('content')


	<ul class="list">
	@foreach($articles as $article)
		<li class="list-item" id={{$article->id}}   style="margin-top: 0px;">
			<a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank" ><h2>{{$article->title}}</h2></a>
            
            <a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank">
            <img src="/images/catalog/{{$article->photo}}" alt="{{$article->title}}">
			</a>
			<br>	  
            <span id="b{{$article->id}}">{{$article->vote_count}}</span>赞
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
			<span>&nbsp; • &nbsp;</span>{{$article->reply_count}}评论
			<span>&nbsp; • &nbsp;</span>{{$article->view_count}}阅读
			</a><br>
			<button  type="button" 	
			         class="btn btn-default btn-lg"	           
			         v-on="click: toggleLike">
            <span class="glyphicon glyphicon-thumbs-up">
            </span>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button  type="button" 	
			         class="btn btn-default btn-lg">
			<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">	           
		    <span class="glyphicon glyphicon-comment">
            </span></a>
            </button>
		</li>	
		<hr>
	@endforeach
    <ul>
@stop