<ul class="list">
  @foreach ($upvotes as $index => $upvote)
   <article class="list-item">
    @if (count($upvote->article))
      <a href="{{ route('articles.show', [$upvote->votable_id]) }}">
      <h2>{{ $upvote->article->title }}</h2>
      </a>
      <a href="{{ route('articles.show', [$upvote->votable_id]) }}">
      <img src="/images/catalog/{{ $upvote->article->photo }}" alt="{{$upvote->article->title}}">
      </a>
      <div class="upvote-body markdown-upvote content-body">
      点赞时间:at <span class="timeago" title="{{ $upvote->created_at }}">{{ $upvote->created_at }}</span>
      </div>
    @else
      <div class="deleted text-center">Data has been deleted.</div>
    @endif
  </article>
  @endforeach
</ul>
{!!$upvotes->render()!!}
