<ul class="list-group row">
    <div class="infos">
      <div class="media-heading meta">
                 {{ $reply->user_id }}
        <span> •  </span>
        <abbr class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</abbr>
          <span> •  </span>

      </div>

      <div class="media-body markdown-reply content-body">
   {{ $reply->body }}
      </div>

    </div>
</ul>
