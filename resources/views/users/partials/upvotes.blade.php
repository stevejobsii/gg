<ul class="list">
  @foreach ($upvotes as $index => $upvote)
   <article class="list-item">
    @if (count($upvote->article))
      <a href="{{ route('articles.show', [$upvote->votable_id]) }}">
      <h2>{{ $upvote->article->title }}</h2>
      </a>
      @if(($upvote->article->type) == '0')
      <a href="{{ action('ArticlesController@show', [$upvote->votable_id])}}"target="_blank">
      <img src="/images/catalog/{{$upvote->article->photo}}" alt="{{$upvote->article->title}}"></a>
      @endif
      @if(($upvote->article->type) == 'mp4')
      <video  width="460" min-height="300" loop onmouseenter="this.play()"  preload="auto" controls>
      <source src="/images/catalog/{{$upvote->article->photo}}" type="video/mp4">
        <div class="badge-item-animated-img">eee</div>
      Your browser does not support the video tag.
      </video>
      @endif
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
