@extends('app')

@section('content')
    @if(isset($user))
    {{$user->name}}的收藏
    @include('users.partials.infonav')
    @endif
    @unless (!$search)
    <br>搜索：{{$search}}的结果
    @endif
	<ul class="list">
	@foreach($articles as $article)
	<article class="list-item" id={{$article->id}}   style="margin-top: 0px;">
		<a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank" ><h2>{{$article->title}}</h2></a>
	    @if($article->type == '0')
	    <a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank">
	    <img src="/images/catalog/{{$article->photo}}" alt="{{$article->title}}"></a>
	    @endif
	    @if($article->type == 'mp4')
	    <video  width="460" min-height="300" loop onmouseenter="this.play()"  preload="auto" >
		  <source src="/images/catalog/{{$article->photo}}" type="video/mp4">
          <img src="/images/catalog/placeholder.png" id = "video-overlay"/>
		Your browser does not support the video tag.
		</video>
		@endif

		<br>	  
	    <h5><span id="b{{$article->id}}">{{$article->vote_count}}</span>赞
		<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
		<span>&nbsp; • &nbsp;</span>{{$article->reply_count}}讨论
		<span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
		</a><br></h5>
		<button  type="button" 	
		         class="btn btn-default btn-lg not_favorited"	           
		         v-on="click: toggleLike">
	    <span class="glyphicon glyphicon-thumbs-up">
	    </span>
	    </button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
	    <button  type="button" 	
		         class="btn btn-default btn-lg not_favorited">	           
	    <span class="glyphicon glyphicon-comment">
	    </span>
	    </button>
	    </a>        
	</article>			      
    <hr>
	@endforeach
    <ul>
    {!!$articles->render()!!}
@stop