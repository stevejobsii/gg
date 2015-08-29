@extends('app')
@section('content')
      {{$user->name}}的收藏
      @include('users.partials.infonav')
      @if (count($upvotes))
      @include('users.partials.upvotes')
      @else
      <div class="empty-block">Dont have any data Yet~~</div>
      @endif
@stop