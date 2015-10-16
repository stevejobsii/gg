<ul class="list col-md-8">
  @foreach ($replies as $index => $reply)
   <article class="list-item">
    @if (count($reply->article))
      <a href="{{ route('articles.show', [$reply->article_id]) }}">
      <h2>{{ $reply->article->title }}</h2>
      </a>
      @if(($reply->article->type) == '.jpg')
      <a href="{{ action('ArticlesController@show', [$reply->article->photo])}}"target="_blank">
      <img src="/images/catalog/{{$reply->article->photo}}{{$reply->article->type}}" alt="{{$reply->article->title}}"></a>
      @endif
      @if($reply->article->type == '_long.jpg')
      <div class="long-post-wrap">
      <a href="{{ action('ArticlesController@show', [$reply->article->photo])}}"target="_blank">
      <img src="/images/catalog/{{$reply->article->photo}}.jpg" alt="{{$reply->article->title}}"></a>
      <a href="{{ action('ArticlesController@show', [$reply->article->photo])}}"target="_blank"class="post-read-more"><i class="glyphicon glyphicon-new-window"></i>&nbsp;&nbsp;查看完整</a>       
      </div>
      @endif
      @if(($reply->article->type) == '.mp4')
      <div class = "video_wrap">
      <h2 class="video_text">Gif</h2>
      <video  width="480" min-height="300" loop preload="auto">
      <source src="/images/catalog/{{$reply->article->photo}}{{$reply->article->type}}" type="video/mp4">
        <div class="badge-item-animated-img">eee</div>
      Your browser does not support the video tag.
      </video>
      </div>
      @endif
      <div class="reply-body markdown-reply content-body">
      <h3 style="padding-bottom: 10px; margin-top: 0px; border-bottom: 1px solid #e5e5e5;"><small>回复:{{ $reply->body }} at <span class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span></small></h3>
      </div>
    @else
      <div class="deleted text-center">Data has been deleted.</div>
    @endif
  </article>
  @endforeach
  {!!$replies->render()!!}
</ul>

@include('sidebar')