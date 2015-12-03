  <div class="form-group fileUpload">
     {!! Form::label('格式： png | jpg | jpeg | mp4') !!}<span class="error">*</span>
          <div class="input-group">
              <span class="input-group-btn">
                  <span class="btn btn-file">
                      <i class="glyphicon glyphicon-cloud-upload text-center"style="color:#777;font-size:60px;"></i>
                      <p style="color:#777;font-size: 20px;">1拉这儿  or  浏览</p>{!! Form::file('image', null) !!}
                  </span>
              </span>
              <input type="text" class="form-control"  placeholder="上传文件名字" readonly>
          </div>
  </div>

  <div class="form-group">
    {!! Form::label('title', '标题') !!}<span class="error">*</span>
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
  </div>
    
    <div class="form-group">
        {!! Form::label('tag_list', '标签') !!}
        {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
    </div>
    
  <div class="group">
    {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
  </div>
  <br>

  @section('footer')
    
  @endsection   