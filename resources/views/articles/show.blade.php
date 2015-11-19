@extends('app')

@section('content')
    <div class = "col-md-1"></div>
    <div class = "col-md-7">
        <div class = "width480">	
            <h2>{{$article->title}}</h2>
            <h3 style="padding-bottom: 10px; margin-top: 0px;"><small><a href="/users/{{$article->user_id}}/articles">作者：{{\App\User::find($article->user_id)->name}}</a>
            @unless ($article->tags->isEmpty())
            标签 |
            @foreach($article->tags as $tag)
            <a href="{{ url('/tags',['name'=>$tag->name]) }}" title="{{ $tag->cname }}" target="_blank">{{ $tag->cname }}</a>
            @endforeach  
            @endif</small>
            @if($previous)
                <div class = "pull-right">
                    <a href="{{ action('ArticlesController@show', $next)}}">
                    <button  type="button"  
                             class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i>          
                    </button>
                    </a>
                    <a href="{{ action('ArticlesController@show', $previous)}}">
                    <button  type="button"  
                             class="btn btn-default"><i class="glyphicon glyphicon-chevron-right"></i>         
                    </button>
                    </a>
                </div>
            @endif</h3>

        <!--article -->
        @if($article->type == '.jpg')
        <img src="/images/catalog/{{$article->photo}}{{$article->type}}" alt="{{$article->title}}">
        @endif

        @if($article->type == '_long.jpg')
        <img src="/images/catalog/{{$article->photo}}_long.jpg" alt="{{$article->title}}">
        @endif

        @if($article->type == '.mp4')
        <div class = "video_wrap">
        <h2 class="video_text">Gif</h2>
        <video  width="480" min-height="300" loop preload="auto">
        <source src="/images/catalog/{{$article->photo}}{{$article->type}}" type="video/mp4">
        Your browser does not support the video tag.
        </video></div>
        @endif
        <h5><strong><span id="b{{$article->photo}}">{{$article->vote_count}}</span>赞
        <span>&nbsp; • &nbsp;</span>{{$article->reply_count}}互动
        <span>&nbsp; • &nbsp;</span>{{$article->view_count}}观摩
        </strong></h5>
        </div><!-- width480 -->

            <div class="width485 btn-vote-reply votebookmark">
                <li><button  type="button"   
                         class="btn btn-default index-upvote"              
                         data-id="{{$article->photo}}"
                         data-toggle="tooltip" data-placement="bottom" title="点赞"><i class="glyphicon glyphicon-thumbs-up"></i>
                </button></li>
                <li><button  type="button"  
                         class="btn btn-default index-bookmark"
                         data-id="{{$article->photo}}"data-title="{{$article->title}}"
                         data-toggle="tooltip" data-placement="bottom" title="书签"><i class="glyphicon glyphicon-bookmark"></i>           
                </button></li>


                @if(Auth::check())
                @if (Auth::user()->can("manage_topics") || Auth::user()->id == $article->user_id) 
                    <li><a href="{{ action('ArticlesController@edit', [$article->photo])}}">
                    &nbsp;&nbsp;<button class="btn btn-warning"data-toggle="tooltip" data-placement="bottom" title="修改"><i class="glyphicon glyphicon-edit"></i></button>
                    </a></li>
                    <li style="float: left" id = 'confirm'>
                    {!! Form::open(array('route' => array('articles.destroy', $article->photo), 'method' => 'delete')) !!}
                        <button type="submit" class="btn btn-danger"data-toggle="tooltip" data-placement="bottom" title="删除"><i class="glyphicon glyphicon-trash"></i></button>
                    {!! Form::close() !!} 
                    </li>      
                @endif
                @endif
                    <div class="pull-right bdsharebuttonbox" data-tag="share_1">
                    <a class="bds_weixin" data-cmd="weixin" data-photo="{{$article->photo}}" data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享微信"></a>
                    <a class="bds_tsina" data-cmd="tsina"data-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享微博"></a>
                    <a class="bds_qzone" data-cmd="qzone" href="#"data-photo="{{$article->photo}}"data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享QQ空间"></a>         
                    </div> 
                    <div class="clearfix"></div>
            </div>
            <hr>

        <!-- Reply -->
        <div class = "reply_list">
            @foreach($article->replies as $reply)
            <span class="anchor" id="{{$reply->id}}"></span>
            <article class="list-item" style="margin-top: 0px;">
                <div class="comment-avatar">
                <a href="{{ route('users.articles', [$reply->user_id]) }}"> 
                    @if(file_exists(public_path('/images/catalog/avatar'.Auth::id().'.jpg'))) 
                        <img src="/images/catalog/avatar{{Auth::id()}}.jpg" id="avatar">
                    @else
                        <img src="/images/catalog/avatardefault.jpg" id="avatar"> 
                    @endif
                </a>
                </div>




                <div class="comment-info">
                    <h5><a href="{{ route('users.articles', [$reply->user_id]) }}"> {{\App\User::find($reply->user_id)->name}}</a>
                    <small><i class = "glyphicon glyphicon-calendar"></i>{{ $reply->created_at }}</small></h5>
                    <!-- Reply upvote/reply on reply-->

                    <div class="comment-content">
                    {{$reply->body}}
                    </div>
                    
                    <div class = "show-reply-vote-count label label-default inline-block">
                        <span id="br{{$reply->id}}">{{$reply->vote_count}}</span>赞
                    </div>

                    <ul class = "btn-vote-reply">
                    @if(Auth::check())
                    @if (Auth::user()->can("manage_topics") || Auth::user()->id == $reply->user_id) 
                    <li>{!! Form::open(array('route' => array('replies.destroy', $reply->id), 'method' => 'delete','style'=>"float:left")) !!}
                    <button type="submit" class="btn btn-danger"data-toggle="tooltip" data-placement="bottom" title="删除"><i class="glyphicon glyphicon-trash"></i></button>
                    {!! Form::close() !!}</li>
                    @endif
                    @endif
                    &nbsp;&nbsp;
                    <li><a href="javascript:void(0)"
                             class="show-upvote"              
                             data-id="{{$reply->id}}"
                             data-toggle="tooltip" data-placement="bottom" title="点赞"><strong><i class="glyphicon glyphicon-thumbs-up"></i></strong>
                    </a></li>
                    <li><a class="show-upvote" href="javascript:void(0)" onclick="replyOne('{{ $reply->user->name }}');" data-toggle="tooltip" data-placement="bottom" title="@.Ta">@</a></li>
                    </ul>
                </div>
                
                <!-- Reply body-->

                

                <div class="clearfix"></div>
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
    @include('sidebar')
@stop

