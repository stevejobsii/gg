@extends('app')

@section('content')
    @if(isset($user))
    {{$user->name}}的收藏
    @include('users.partials.infonav')
    @endif
	<ul class="list col-md-6">
	@unless (!$search)
    <br>搜索：{{$search}}的结果
    @endif
	@foreach($articles as $article)
	<article class="list-item" id={{$article->id}} style="margin-top: 0px;">
		<a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank" ><h3>{{$article->title}}</h3></a>
	    @if($article->type == '0')
	    <a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank">
	    <img src="/images/catalog/{{$article->photo}}" alt="{{$article->title}}"></a>
	    @endif
	    @if($article->type == 'mp4')
	    <div class = "video_wrap">
	    <h2 class="video_text">Gif</h2>
	    <video  width="460" min-height="300" loop preload="auto" >
		  <source src="/images/catalog/{{$article->photo}}" type="video/mp4">
		Your browser does not support the video tag.
		</video>
		</div>
		@endif
		<br>	  
	    <h5><span id="b{{$article->id}}">{{$article->vote_count}}</span>赞
		<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
		<span>&nbsp; • &nbsp;</span>{{$article->reply_count}}讨论
		<span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
		</a><br></h5>
		<button  type="button" 	
		         class="btn btn-default btn-lg not_favorited"	           
		         v-on="click: toggleLike"><strong>点&nbsp;&nbsp;赞</strong>
	    </button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
	    <button  type="button" 	
		         class="btn btn-default btn-lg not_favorited"><strong>讨&nbsp;&nbsp;论</strong>           
	    </button>
	    </a>        
	</article>			      
    <hr>
	@endforeach
    <ul>
    {!!$articles->appends(Request::except('page'))->render()!!}
@stop