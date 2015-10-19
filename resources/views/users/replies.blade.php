@extends('app')
@section('content')
      @include('users.partials.infonav')
      @if (count($replies))
      @include('users.partials.replies')
      @else
      <div class="empty-block">Dont have any data Yet~~</div>
      @endif
@stop