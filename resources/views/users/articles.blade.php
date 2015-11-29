@extends('app')
@section('content')
      @include('users.partials.infonav')
      @if (count($articles))
	  @include('users.partials.articles')
      @else
      <div class="empty-block">没有任何记录哦~~</div>
      @endif
@stop
