	<div class="group">
		{!! Form::label('title', '题目：') !!}<span class="error">*</span>
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>
    
    <div class="form-group">
        {!! Form::label('tag_list', '标签分类：') !!}
        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
    
    <div class="form-group">
       {!! Form::label('上传图片格式:|png|jpg|jpeg|mp4|小于2M') !!}<span class="error">*</span>
       {!! Form::file('image', null) !!}
    </div>
  
	<div class="group">
		{!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
	</div>
	<br>

	@section('footer')
    
    @endsection   