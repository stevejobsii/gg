
@extends('app')

@section('content')

    <h1>{{$article->title}}</h1>
    <button  id="vote"
            type="button" 
            class="btn btn-default btn-lg"
            v-class="active: liked"
            v-on="click: toggleLike "
    >
    <span class="glyphicon glyphicon-thumbs-up">
    </span>  
    </button>
    <span id="b{{$article->id}}">{{$article->vote_count}}</span>个赞
    <br><a href="/users/{{$article->user_id}}/articles">作者：{{\App\User::find($article->user_id)->name}}</a>
    <br>{{$article->view_count}}看过
   
    @unless ($article->tags->isEmpty())
    <br>
    tags |
    @foreach($article->tags as $tag)
    <a href="{{ url('/tags',['name'=>$tag->name]) }}" title="{{ $tag->name }}" target="_blank">{{ $tag->name }}</a>
    @endforeach  
    @endif
	<hr>

<div class = "col-md-6">
	
    @if($article->type == '0')
    <a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank">
    <img src="/images/catalog/{{$article->photo}}" alt="{{$article->title}}"></a>
    @endif
    @if($article->type == 'mp4')
    <div class = "video_wrap">
    <h2 class="video_text">Gif</h2>
    <video  width="460" min-height="300" loop preload="auto">
      <source src="/images/catalog/{{$article->photo}}" type="video/mp4">
    Your browser does not support the video tag.
    </video>
    </div>
    @endif
    
    <div>共有{{$article->reply_count}}个评论</div>

    <!-- edit -->
    @if(Auth::check())
    @if (Auth::user()->can("manage_topics") || Auth::user()->id == $article->user_id) 
        <a href="{{ action('ArticlesController@edit', [$article->id])}}">
        <button class="btn btn-default">修改</button>
        </a>
        <div style="float: left" id = 'confirm'>
        {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
            <button type="submit" class="btn btn-default">删除</button>
        {!! Form::close() !!} 
        </div> 
    @endif
    @endif

    <!-- Reply -->
    @foreach($article->replies as $reply)
    <li>{{\App\User::find($reply->user_id)->name}}&nbsp;&nbsp;回复:&nbsp;{{$reply->body}}&nbsp;&nbsp;
    发表时间：{{ $reply->created_at }}
    </li>
    @endforeach
    <div class="reply-box form box-block">
    <hr>
    {!! Form::open(['route' => 'replies.store', 'id' => 'reply-form', 'method' => 'post']) !!}
    <input type="hidden" name="article_id" value="{{ $article->id }}" />
    <div class="form-group">
    {!! Form::textarea('body', null, ['class' => 'form-control',
                                                 'rows' => 3,
                                                 'placeholder' => '请发布评论',
                                                 'style' => "overflow:hidden",
                                                 'id' => 'reply_content']) !!}
    </div>
    <div class="form-group status-post-submit">
    {!! Form::submit('回复', ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) !!}
    </div>
    {!! Form::close() !!}
    </div>
</div>
@stop

