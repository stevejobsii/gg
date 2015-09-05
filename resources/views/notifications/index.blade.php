@extends('app')


@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
    <h5>通知中心</h5>
    </div>
    @if (count($notifications))
        <div class="panel-body remove-padding-horizontal">
            <ul class="list-group row">
              @foreach ($notifications as $notification)
                <li class="list-group-item" style="margin-top: 0px;">
                @if (count($notification->article))
                <div class="infos">
                <a href="{{ route('users.articles', [$notification->from_user_id]) }}">
                {{ $notification->fromUser->name }}
                </a>
                •{{ $notification->present()->lableUp }}
                <a href="{{ route('articles.show', [$notification->article->id])}}">
                {{{ str_limit($notification->article->title, '100') }}}
                </a>
                • at • {{ $notification->created_at }}
                <div>
                {{ $notification->body }}
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
        <div class="empty-block">You dont have any notice yet!</div>
        </div>
    @endif
</div>
@stop