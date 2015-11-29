@extends('app')
@section('content')
      @include('users.partials.infonav')
      @if (count($upvotes))
      @include('users.partials.upvotes')
      @else
      <div class="empty-block">没有任何记录哦~~</div>
      @endif
@stop