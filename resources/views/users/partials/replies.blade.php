<ul class="list">
  @foreach ($replies as $index => $reply)
   <article class="list-item">
    @if (count($reply->article))
      <a href="{{ route('articles.show', [$reply->article_id]) }}">
      <h2>{{ $reply->article->title }}</h2>
      </a>
      <a href="{{ route('articles.show', [$reply->article_id]) }}">
      <img src="/images/catalog/{{ $reply->article->photo }}" alt="{{$reply->article->title}}">
      </a>
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
