
@extends('app')

@section('content')
    <div class = "col-md-8">
        <div class = "width480">	
        <h1>{{$article->title}}</h1>
        <h3 style="padding-bottom: 10px; margin-top: 0px; border-bottom: 1px solid #e5e5e5;"><small><a href="/users/{{$article->user_id}}/articles">作者：{{\App\User::find($article->user_id)->name}}</a>
        @unless ($article->tags->isEmpty())
        标签 |
        @foreach($article->tags as $tag)
        <a href="{{ url('/tags',['name'=>$tag->name]) }}" title="{{ $tag->name }}" target="_blank">{{ $tag->name }}</a>
        @endforeach  
        @endif</small>
        @if($previous)
            <div class = "pull-right">
                <a href="{{ action('ArticlesController@show', $previous)}}">
                <button  type="button"  
                         class="btn btn-default"><strong>下一张</strong>           
                </button>
                </a>
            </div>
        @endif</h3>
        </div>

        <!--article -->
        @if($article->type == '.jpg')
        <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
        <img src="/images/catalog/{{$article->photo}}{{$article->type}}" alt="{{$article->title}}"></a>
        @endif

        @if($article->type == '_long.jpg')
        <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
        <img src="/images/catalog/{{$article->photo}}_long.jpg" alt="{{$article->title}}"></a>
        @endif

        @if($article->type == '.mp4')
        <div class = "video_wrap">
        <h2 class="video_text">Gif</h2>
        <video  width="480" min-height="300" loop preload="auto">
        <source src="/images/catalog/{{$article->photo}}{{$article->type}}" type="video/mp4">
        Your browser does not support the video tag.
        </video></div>
        @endif
        <h5><strong><span id="b{{$article->id}}">{{$article->vote_count}}</span>赞
        <span>&nbsp; • &nbsp;</span>{{$article->reply_count}}互动
        <span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
        </strong></h5>
        

            <div class="width485 votebookmark btn-vote-reply">
            <upvotebookmark when-applied="@{{toggleLike}}" when-bookmark="@{{bookmark}}"id="{{$article->id}}"title="{{$article->title}}"photoname="{{$article->photo}}"></upvotebookmark>
            @if(Auth::check())
            @if (Auth::user()->can("manage_topics") || Auth::user()->id == $article->user_id) 
                <li><a href="{{ action('ArticlesController@edit', [$article->photo])}}">
                &nbsp;&nbsp;<button class="btn btn-warning">修改</button>
                </a></li>
                <li style="float: left" id = 'confirm'>
                {!! Form::open(array('route' => array('articles.destroy', $article->photo), 'method' => 'delete')) !!}
                    <button type="submit" class="btn btn-danger">删除</button>&nbsp;&nbsp;&nbsp;
                {!! Form::close() !!} 
                </li>      
            @endif
            @endif
                <div class="pull-right bdsharebuttonbox" data-tag="share_1">
                <a class="bds_weixin" data-cmd="weixin" data-photo="{{$article->photo}}" data-type="{{$article->type}}"data-title="{{$article->title}}"></a>
                <a class="bds_tsina" data-cmd="tsina"data-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"></a>
                <a class="bds_qzone" data-cmd="qzone" href="#"data-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"></a>         
                </div> 
                <div class="clearfix"></div>
            </div>
            <hr>

        <!-- Reply -->
        <div class = "reply_list ">
            @foreach($article->replies as $reply)
            <article class="list-item" style="margin-top: 0px;">
                <h4 style="float:left;"><a href="{{ route('users.articles', [$reply->user_id]) }}"> {{\App\User::find($reply->user_id)->name}}</a>
                <small>{{ $reply->created_at }}</small></h4>
                
                <!-- Reply upvote/reply on reply-->
                <ul class = "pull-right btn-vote-reply" style="margin-bottom: 0px;">
                @if(Auth::check())
                @if (Auth::user()->can("manage_topics") || Auth::user()->id == $reply->user_id) 
                <li>{!! Form::open(array('route' => array('replies.destroy', $reply->id), 'method' => 'delete','style'=>"float:left")) !!}
                <button type="submit" class="btn btn-danger">删除</button>
                {!! Form::close() !!}</li>
                @endif
                @endif
                &nbsp;&nbsp;
                <li><span id="b{{$reply->id}}">{{$reply->vote_count}}</span>个赞</li>
                <upvote when-applied="@{{toggleLike}}" id="{{$reply->id}}"></upvote>
                <li><button class="btn btn-info"  href="javascript:void(0)" onclick="replyOne('{{ $reply->user->name }}');">@.{{\App\User::find($reply->user_id)->name}}</button></li>
                </ul>
                
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
            @if(Auth::check())
            {!! Form::textarea('body', null, ['class' => 'form-control',
                                                         'rows' => 3,
                                                         'placeholder' => '请发布评论，@用户将收到通知',
                                                         'style' => "overflow:hidden",
                                                         'id' => 'reply_content']) !!}
            @else
            {!! Form::textarea('body', null, ['class' => 'form-control', 'disabled' => 'disabled', 
                                                         'rows' => 3,
                                                         'placeholder' => '请先登陆后发布评论',
                                                         'style' => "overflow:hidden",
                                                         'id' => 'reply_content']) !!}
            @endif
            </div>

            <div class="form-group status-post-submit">
            @if(Auth::check())
            {!! Form::submit('回复', ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) !!}
            @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
        <script id="upvote-template" type="x-template">
                    <li><button  type="button"  
                             class="btn btn-default"               
                             v-on="click: toggleLike"><strong>点赞</strong>
                    </button></li>
        </script>
    @include('sidebar')
@stop

