@extends('app')


@section('content')


      @include('users.partials.infonav')
      @if (count($articles))
	    @include('users.partials.articles')
      @else
      <div class="empty-block">Dont have any data Yet~~</div>
      @endif

@stop
