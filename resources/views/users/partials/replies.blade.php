<ul class="list">
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
      @if(($reply->article->type) == 'mp4')
      <video  width="460" min-height="300" loop onmouseenter="this.play()"  preload="auto" controls>
      <source src="/images/catalog/{{$reply->article->photo}}" type="video/mp4">
        <div class="badge-item-animated-img">eee</div>
      Your browser does not support the video tag.
      </video>
      @endif
      <div class="reply-body markdown-reply content-body">
      回复:{{ $reply->body }} at <span class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span>
      </div>
    @else
      <div class="deleted text-center">Data has been deleted.</div>
    @endif
  </article>
  @endforeach
</ul>
{!!$replies->render()!!}
