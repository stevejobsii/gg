<ul class="list-group">

  @foreach ($articles as $index => $article)
   <li class="list-group-item" >
      <a href="{{ route('articles.show', [$article->id]) }}" title="{{{ $article->title }}}">
        {{{ str_limit($article->title, '100') }}}
      </a>
        <span> • </span>
        {{ $article->reply_count }}
        <span> • </span>
        <span class="timeago">{{ $article->created_at }}</span>



  </li>
  @endforeach

</ul>
