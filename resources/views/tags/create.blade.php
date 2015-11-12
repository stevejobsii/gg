@extends('app')

@section('content')

    <h2>~创建tag~</h2>
	<hr>
  
       
  {!! Form::open(['url'=>'tags', 'files' => false]) !!}
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
 

 @include('errors.list')
	

@stop