<div class = "col-md-1"></div>
<ul class="list col-md-7">
  @foreach ($upvotes as $index => $upvote)
   <article class="list-item">
    @if (count($upvote->article))
      <a href="{{ route('articles.show', [$upvote->article_id]) }}">
      <h2>{{ $upvote->article->title }}</h2>
      </a>
      @if(($upvote->article->type) == '.jpg')
      <a href="{{ action('ArticlesController@show', [$upvote->article->photo])}}"target="_blank">
      <img src="/images/catalog/{{$upvote->article->photo}}{{$upvote->article->type}}" alt="{{$upvote->article->title}}"></a>
      @endif
      @if($upvote->article->type == '_long.jpg')
      <div class="long-post-wrap">
      <a href="{{ action('ArticlesController@show', [$upvote->article->photo])}}"target="_blank">
      <img src="/images/catalog/{{$upvote->article->photo}}.jpg" alt="{{$upvote->article->title}}"></a>
      <a href="{{ action('ArticlesController@show', [$upvote->article->photo])}}"target="_blank"class="post-read-more"><i class="glyphicon glyphicon-new-window"></i>&nbsp;&nbsp;查看完整</a>       
      </div>
      @endif
      @if(($upvote->article->type) == '.mp4')
      <div class = "video_wrap">
      <h2 class="video_text">Gif</h2>
      <video  width="480" min-height="300" loop preload="auto">
      <source src="/images/catalog/{{$upvote->article->photo}}{{$upvote->article->type}}" type="video/mp4">
        <div class="badge-item-animated-img">eee</div>
      Your browser does not support the video tag.
      </video>
      </div>
      @endif
      <div class="reply-body markdown-reply content-body">
      <h3 style="padding-bottom: 10px; margin-top: 0px; border-bottom: 1px solid #e5e5e5;"><small>点赞 @<span class="timeago" title="{{ $upvote->created_at }}">{{ $upvote->created_at }}</span></small></h3>
      </div>
    @elseif(count($upvote->reply))
      <div>
      回复：<a href="{{ action('ArticlesController@show', [$upvote->reply->article->photo])}}">{{$upvote->reply->body}}</a>
      <h3 style="padding-bottom: 10px; margin-top: 0px; border-bottom: 1px solid #e5e5e5;"><small>点赞 @<span class="timeago" title="{{ $upvote->created_at }}">{{ $upvote->created_at }}</span></small></h3>
      </div>
    @else
      <div class="deleted text-center">Data has been deleted.</div>
    @endif
  </article>
  @endforeach
  {!!$upvotes->render()!!}
</ul>

@include('sidebar')

