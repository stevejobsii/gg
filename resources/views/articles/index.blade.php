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
	    <span id="b{{$article->id}}">{{$article->vote_count}}</span>Good
		<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
		<span>&nbsp; • &nbsp;</span>{{$article->reply_count}}讨论
		<span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
		</a><br>
		<button  type="button" 	
		         class="btn btn-naked btn-lg "	           
		         v-on="click: toggleLike">
	    <span class="glyphicon glyphicon-thumbs-up not_favorited">
	    </span>
	    </button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
	    <button  type="button" 	
		         class="btn btn-naked btn-lg not_favorited">	           
	    <span class="glyphicon glyphicon-comment">
	    </span>
	    </button>
	    </a>        
		</li>			
        
        <hr>
	@endforeach
    <ul>
    {!!$articles->render()!!}
    
@stop