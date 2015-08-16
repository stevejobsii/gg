
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
    @unless (! $article->body)
    <br>内容：{{$article->body}}
    @endif
    <br>作者：{{\App\User::find($article->user_id)->name}}
    <br>创建时间：{{$article->published_at}}
    <br>{{$article->view_count}}看过
    @unless ($article->tags->isEmpty())
    <br>
    tags |
    @foreach($article->tags as $tag)
    <a href="{{ url('/tags',['name'=>$tag->name]) }}" title="{{ $tag->name }}" target="_blank">{{ $tag->name }}</a>
    @endforeach  
    @endif

	  <hr>
		<article>
		<img src="/images/catalog/{{$article->photo}}">
		</article>	
    <div>共有{{$article->reply_count}}个评论</div>
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
@stop