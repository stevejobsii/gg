	<div class="form-group">
		{!! Form::label('title', '标题') !!}<span class="error">*</span>
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>
    
    <div class="form-group">
        {!! Form::label('tag_list', '标签') !!}
        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
    
    <div class="form-group">
       {!! Form::label('格式： png | jpg | jpeg | mp4') !!}<span class="error">*</span>
       {!! Form::file('image', null) !!}
       <p class="help-block">上传应小于2M。</p>
    </div>
  
	<div class="group">
		{!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
	</div>
	<br>

	@section('footer')
    
    @endsection   