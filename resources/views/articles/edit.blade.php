@extends('app')

@section('content')

	<h1>Edit Article: {!! $article->title !!}</h1>
	<hr>

	{!! Form::model($article, ['method'=>'PATCH', 'action'=>['ArticlesController@update',$article->photo],'files' => true]) !!}	    
		    <div class="group">
				{!! Form::label('title', '题目：') !!}
				{!! Form::text('title', null, ['class'=>'form-control']) !!}
			</div>
		    <div class="form-group">
		        {!! Form::label('tag_list', '标签分类：') !!}
		        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
		    </div>
			<div class="group">
				{!! Form::submit('提交', ['class'=>'btn btn-primary form-control']) !!}
			</div>
	{!! Form::close() !!}

	<br>

	@include('errors.list')

@stop