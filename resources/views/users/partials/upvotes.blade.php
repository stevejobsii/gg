<ul class="list col-md-6">
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
      <div class = "video_wrap">
      <h2 class="video_text">Gif</h2>
      <video  width="460" min-height="300" loop preload="auto">
      <source src="/images/catalog/{{$upvote->article->photo}}" type="video/mp4">
      Your browser does not support the video tag.
      </video>
      </div>
      @endif
      <div class="upvote-body markdown-upvote content-body">
      点赞时间:at <span class="timeago" title="{{ $upvote->created_at }}">{{ $upvote->created_at }}</span>
      </div>
    @else
      <div class="deleted text-center">Data has been deleted.</div>
    @endif
  </article>
  @endforeach
  {!!$upvotes->render()!!}
</ul>

