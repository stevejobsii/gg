		<div class="group">
			{!! Form::label('title', '题目：') !!}
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
		</div>

		<div class="group">
			{!! Form::label('body', '内容：') !!}
			{!! Form::text('body', null, ['class'=>'form-control']) !!}
		</div>

		<div class="group">
			{!! Form::label('published_at', '发布时间：') !!}
			{!! Form::input('date', 'published_at', date('Y-m-d'), ['class'=>'form-control']) !!}
		</div>
        
        <div class="form-group">
	        {!! Form::label('tag_list', '标签分类：') !!}
	        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
        </div>
        
        <div class="form-group">
           {!! Form::label('Product Image') !!}
           {!! Form::file('image', null) !!}
        </div>

		<div class="group">
			{!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
		</div>
		<br>
		@section('footer')
	    <script type="text/javascript">
		$('#tag_list').select2({
			placeholder: '选择文章标签'
		});
	    </script>
	    @endsection