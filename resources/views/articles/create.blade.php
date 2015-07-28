@extends('app')

@section('content')

	<h1>Write a New Article</h1>
	<hr>

	{!! Form::open(['url'=>'articles', 'enctype'=>'multipart/form-data']) !!}
		@include('articles.form',['submitButtonText'=>'Add Article'])
	{!! Form::close() !!}

	<br>

	@include('errors.list')

@stop