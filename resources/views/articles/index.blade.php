@extends('app')

@section('content')
    @if(isset($user))
    {{$user->name}}的收藏
    @include('users.partials.infonav')
    @endif
    <div class= "col-md-8">
	<ul class="list votebookmark">	
	@unless (!$search)
    <br>搜索：{{$search}}的结果
    @endif
	@foreach($articles as $article)
	<article class="list-item" id={{$article->id}} style="margin-top: 0px;">
		<a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank" ><h3>{{$article->title}}</h3></a>
	    @if($article->type == '.jpg')
	    <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
	    <img src="/images/catalog/{{$article->photo}}{{$article->type}}" alt="{{$article->title}}"></a>
	    @endif
	    @if($article->type == '_long.jpg')
        <div class="long-post-wrap">
	    <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
	    <img src="/images/catalog/{{$article->photo}}.jpg" alt="{{$article->title}}"></a>
        <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank"class="post-read-more"><i class="glyphicon glyphicon-new-window"></i>&nbsp;&nbsp;查看完整</a>       
        </div>
	    @endif
	    @if($article->type == '.mp4')
	    <div class = "video_wrap">
	    <h2 class="video_text">Gif</h2>
	    <video  width="480" min-height="300" loop preload="auto" >
		  <source src="/images/catalog/{{$article->photo}}{{$article->type}}" type="video/mp4">
		Your browser does not support the video tag.
		</video>
		</div>
		@endif	  
	    <h5><strong><span id="b{{$article->id}}">{{$article->vote_count}}</span>赞
		<a href="{{ action('ArticlesController@show', [$article->photo])}}" target="_blank">
		<span>&nbsp; • &nbsp;</span>{{$article->reply_count}}互动
		<span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
		</a></strong></h5>
		<div class="width485">
		<div class="pull-left">
			<ul class="btn-vote-reply">
            <upvotebookmark when-applied="@{{toggleLike}}" when-bookmark="@{{bookmark}}"id="{{$article->id}}"title="{{$article->title}}"photoname="{{$article->photo}}"></upvotebookmark>
		    <li><a href="{{ action('ArticlesController@show', [$article->photo])}}" target="_blank">
		    <button  type="button" 	
			         class="btn btn-default"><strong>互动</strong>           
		    </button>
		    </a></li>
		    </ul>
		</div>
        <div class="pull-right bdsharebuttonbox" data-tag="share_1">
        <a class="bds_weixin" data-cmd="weixin" data-photo="{{$article->photo}}" data-type="{{$article->type}}"data-title="{{$article->title}}"></a>
        <a class="bds_tsina" data-cmd="tsina"data-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"></a>
        <a class="bds_qzone" data-cmd="qzone" href="#"data-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"></a>	        
        </div> 
        </div>
	    <div class="clearfix"></div>

	</article>			      
    <hr>
	@endforeach
    </ul><h1>{!!$articles->appends(Request::except('page'))->render()!!}</h1>
    </div>
    @include('sidebarful')
@stop
