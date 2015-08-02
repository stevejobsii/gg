@extends('app')

@section('content')

	<h1>{{$article->title}}</h1>
    <br>
    <a href="{{ route('articles.upvote', $article->id) }}">点赞</a><i>（一个id只能点一次）</i>
        已有{{ $article->vote_count }}个赞
        <br>内容：{{$article->body}}
        <br>作者：{{\App\User::find($article->user_id)->name}}
        <br>创建时间：{{$article->published_at}}
        @unless ($article->tags->isEmpty())
    <h5>Tags:</h5>
        <ul>
        @foreach($article->tags as $tag)
        <li>{{$tag->name}}</li>
        @endforeach
        </ul>
      
    @endif
    
	<hr>
		<article>

			<div class="body">
				<img src="/images/catalog/{{$article->photo}}">
			</div>
		</article>	
    <div>共有{{$article->reply_count}}个评论</div>
        @foreach($article->replies as $reply)
       <li> 评论员：{{\App\User::find($reply->user_id)->name}}&nbsp;&nbsp;回复{{$reply->body}}&nbsp;&nbsp;
 <abbr class="timeago" title="{{ $reply->created_at }}">发表时间：{{ $reply->created_at }}</abbr>
       </li>
        @endforeach
    <div class="reply-box form box-block">
    <hr>
    {!! Form::open(['route' => 'replies.store', 'id' => 'reply-form', 'method' => 'post']) !!}
      <input type="hidden" name="article_id" value="{{ $article->id }}" />
      <div class="form-group">
    {!! Form::textarea('body', null, ['class' => 'form-control',
                                                 'rows' => 5,
                                                 'placeholder' => '请发布评论。',
                                                 'style' => "overflow:hidden",
                                                 'id' => 'reply_content']) !!}
        </div>
        <div class="form-group status-post-submit">
    {!! Form::submit('回复', ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) !!}
        </div>
    {!! Form::close() !!}
</div>
@stop