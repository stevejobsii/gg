@extends('app')

@section('content')
	<h1>Welcome, this is {!! $title !!}</h1>

@stop


@section('contacts')

	@if (count($contacts))
	<h3>Contacts:</h3>	

	
		@foreach ($contacts as $contact)
			<li>{{$contact}}</li>
		@endforeach	
	@endif
@stop