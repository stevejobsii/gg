@extends('app')
@section('content')
      @include('users.partials.infonav')
      @if (count($upvotes))
      @include('users.partials.upvotes')
      @else
      <div class="empty-block">Dont have any data Yet~~</div>
      @endif
@stop