@extends('app')

@section('content')
    @if(isset($user))
    {{$user->name}}的收藏
    @include('users.partials.infonav')
    @endif
    <div class= "col-md-9">
	<ul class="list">
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
	    <h5><strong><span id="b{{$article->id}}">{{$article->vote_count}}</span>赞
		<a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
		<span>&nbsp; • &nbsp;</span>{{$article->reply_count}}讨论
		<span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
		</a></strong></h5>
		<div>
		<div class="left">
			<ul class="btn-vote-reply"><li><button  type="button" 	
			         class="btn btn-default not_favorited"	           
			         v-on="click: toggleLike"><strong>点&nbsp;&nbsp;赞</strong>
		    </button></li>
		    <li><a href="{{ action('ArticlesController@show', [$article->id])}}" target="_blank">
		    <button  type="button" 	
			         class="btn btn-default not_favorited"><strong>讨&nbsp;&nbsp;论</strong>           
		    </button>
		    </a></li></ul>
		</div>
        <div class="pull-right">
            <ul class="btn-vote-reply"><li>
            <button class="btn btn-default"><strong>Weibo</strong></button></li>
            <li><button class="btn btn-default"><strong>WeiXin</strong></button></li>
            </ul>
	    </div>  
	    <div class="clearfix"></div>
	</article>			      
    <hr>
	@endforeach
    </ul>{!!$articles->appends(Request::except('page'))->render()!!}
    </div>
    
    <div class="col-md-3 side-bar">
    <wb:login-button type="1,2" onlogin="login" onlogout="logout">登录按钮</wb:login-button>
    <a class="btn btn-lg-create" href=" articles/create "><strong>
	    <i class="glyphicon glyphicon-user"></i>用 QQ 登 陆</strong></a>
	    <div class="btn-group">
	    <a class="btn btn-lg-create" href=" articles/create "><strong>
	    <i class="glyphicon glyphicon-pencil"></i>发 布 新 帖</strong></a>
	    </div>
    </div>
</div>
@stop