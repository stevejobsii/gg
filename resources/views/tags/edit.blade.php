@extends('app')

@section('content')

	<h1>Edit Tag</h1>
	<hr>

	{!! Form::model($tag, ['method'=>'PATCH', 'action'=>['TagsController@update',$tag->name],'files' => false]) !!}	    
		    <div class="group">
				{!! Form::label('name', '英文名：') !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>
			<div class="group">
				{!! Form::label('cname', '中文名：') !!}
				{!! Form::text('cname', null, ['class'=>'form-control']) !!}
			</div>
			<div class="group">
				{!! Form::submit('提交', ['class'=>'btn btn-primary form-control']) !!}
			</div>
	{!! Form::close() !!}
	<br>
	@include('errors.list')

@stop