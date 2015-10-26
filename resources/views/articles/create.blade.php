@extends('app')

@section('content')

    <h2>~放图过来~</h2>
	<hr>
  
       
  {!! Form::open(['url'=>'articles', 'files' => true]) !!}
    @include('articles.form',['submitButtonText'=>'分享图片'])
  {!! Form::close() !!}
 

 @include('errors.list')
	

@stop