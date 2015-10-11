<ul class="list col-md-8">
  @foreach ($replies as $index => $reply)
   <article class="list-item">
    @if (count($reply->article))
      <a href="{{ route('articles.show', [$reply->article_id]) }}">
      <h2>{{ $reply->article->title }}</h2>
      </a>
      @if(($reply->article->type) == '0')
      <a href="{{ action('ArticlesController@show', [$reply->article->id])}}"target="_blank">
      <img src="/images/catalog/{{$reply->article->photo}}" alt="{{$reply->article->title}}"></a>
      @endif
      @if($reply->article->type == 'longimage')
      <a href="{{ action('ArticlesController@show', [$article->id])}}"target="_blank">
      <img src="/images/catalog/long{{$article->photo}}" alt="{{$article->title}}"></a>
      @endif
      @if(($reply->article->type) == 'mp4')
      <div class = "video_wrap">
      <h2 class="video_text">Gif</h2>
      <video  width="480" min-height="300" loop preload="auto">
      <source src="/images/catalog/{{$reply->article->photo}}" type="video/mp4">
        <div class="badge-item-animated-img">eee</div>
      Your browser does not support the video tag.
      </video>
      </div>
      @endif
      <div class="reply-body markdown-reply content-body">
      回复:{{ $reply->body }} at <span class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span>
      </div>
    @else
      <div class="deleted text-center">Data has been deleted.</div>
    @endif
  </article>
  @endforeach
  {!!$replies->render()!!}
</ul>

@include('sidebar')