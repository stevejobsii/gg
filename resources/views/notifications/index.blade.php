@extends('app')


@section('content')

    @if (count($notifications))
        <div>
            <ul class="list-group row">
              <h5>通知中心</h5>
              @foreach ($notifications as $notification)
                <li class="list-group-item" style="margin-top: 0px;">
                @if (count($notification->article))
                <div class="infos">
                    @if (count($notification->from_user_id))
                    <a href="{{ route('users.articles', [$notification->from_user_id]) }}">
                    {{ $notification->fromUser->name }}
                    </a>
                    @else
                    匿名
                    @endif
                {{ $notification->present()->lableUp }}
                <a href="{{ route('articles.show', [$notification->article->photo])}}">
                {{{ str_limit($notification->article->title, '100') }}}
                </a>
                    于{{ $notification->created_at }}
                <div>
                @if ($notification->body)
                评论：{{ $notification->body }}
                @endif
                </div>
                </div>
                @else
                <div class="deleted text-center">Data has been deleted.</div>
                @endif
                </li>
              @endforeach
            </ul>
        </div>
    @else
        <div class="panel-body">
        <div class="empty-block">您暂时还没有什通知或信息！</div>
        </div>
    @endif
</div>
@stop