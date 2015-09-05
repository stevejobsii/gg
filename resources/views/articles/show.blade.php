
@extends('app')

@section('content')

    <h1>{{$article->title}}</h1>
    <h4><a href="/users/{{$article->user_id}}/articles">作者：{{\App\User::find($article->user_id)->name}}</a><small>&nbsp;&nbsp;放图时间:&nbsp;{{$article->created_at}}</small></h4>
   
    @unless ($article->tags->isEmpty())
    <br>
    tags |
    @foreach($article->tags as $tag)
    <a href="{{ url('/tags',['name'=>$tag->name]) }}" title="{{ $tag->name }}" target="_blank">{{ $tag->name }}</a>
    @endforeach  
    @endif
	<hr>

<div class = "col-md-6">	
    <!--article -->
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
    <div>共有{{$article->reply_count}}个评论&nbsp; • &nbsp;{{$article->view_count}}人看过</div>

    <!-- upvote/edit/delete -->
    <button  id="vote"
            type="button" 
            class="btn btn-success"
            v-class="active: liked"
            v-on="click: toggleLike ">
    <span id="b{{$article->id}}">{{$article->vote_count}}</span>个赞
    </button>
    @if(Auth::check())
    @if (Auth::user()->can("manage_topics") || Auth::user()->id == $article->user_id) 
        <a href="{{ action('ArticlesController@edit', [$article->id])}}">
        &nbsp;&nbsp;<button class="btn btn-warning">修改</button>
        </a>
        <div style="float: left" id = 'confirm'>
        {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
            <button type="submit" class="btn btn-danger">删除</button>&nbsp;&nbsp;&nbsp;
        {!! Form::close() !!} 
        </div>      
    @endif
    @endif
    <hr>

    <!-- Reply -->
    <div class = "reply_list ">
        @foreach($article->replies as $reply)
        <article class="list-item" id={{$reply->id}} style="margin-top: 0px;">
            <a href="{{ route('users.articles', [$reply->user_id]) }}"> {{\App\User::find($reply->user_id)->name}}</a>
            <small>{{ $reply->created_at }}</small>
            
            <!-- Reply upvote/reply on reply-->
            <div class = "pull-right">
            @if(Auth::check())
            @if (Auth::user()->can("manage_topics") || Auth::user()->id == $reply->user_id) 
            {!! Form::open(array('route' => array('replies.destroy', $reply->id), 'method' => 'delete','style'=>"float:left")) !!}
                <button type="submit" class="btn btn-danger">删除</button>
            {!! Form::close() !!}  
            @endif
            @endif
            &nbsp;&nbsp;<button type="button" 
                    class="btn btn-success"
                    v-on="click: toggleLike"
                    ><span id="b{{$reply->id}}">{{$reply->vote_count}}</span>个赞
            </button>
            &nbsp;<button class="btn btn-info"  href="javascript:void(0)" onclick="replyOne('{{ $reply->user->name }}');">@.{{\App\User::find($reply->user_id)->name}}</button>
            </div>
            
            <!-- Reply body-->
            <br><br>
            
            回复:&nbsp;{{$reply->body}}
        <hr>
        </article>
        @endforeach
    </div>
    
    <!-- Reply box-->   
    <div class="reply-box form box-block">
    
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

