@extends('app')

@section('content')

    <h1>Write a New Article</h1>
	<hr>


	{!! Form::open(['url'=>'articles', 'files' => true]) !!}
		@include('articles.form',['submitButtonText'=>'分享图片'])
	{!! Form::close() !!}

	<br>
 

	@include('errors.list')

@stop