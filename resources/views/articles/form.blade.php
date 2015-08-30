	<div class="group">
		{!! Form::label('title', '题目：') !!}
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>
    
    <div class="form-group">
        {!! Form::label('tag_list', '标签分类：') !!}
        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
    
    <div class="form-group">
       {!! Form::label('上传图片:png|jpg|mp4') !!}
       {!! Form::file('image', null) !!}
    </div>
  
	<div class="group">
		{!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
	</div>
	<br>

	@section('footer')
    <script type="text/javascript">
	$('#tag_list').select2({
		placeholder: '选择图片标签'
	});
    </script> 
    
    @endsection   