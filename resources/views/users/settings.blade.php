@extends('app')
@section('content')
	  <style>
	  body {
	      position: relative;
	  }
	  ul.nav-pills {
	      position: fixed;
	  }
	  </style>

  <div class="row">
    <nav class="col-md-2" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
      <h3>用户中心</h3>
        <li class="active"><a href="#user-head">头像设置</a></li>
        <li><a href="#user-info">个人信息</a></li>
        <li><a href="#user-keyreset">密码设置</a></li>
      </ul>
    </nav>

    <div class="col-md-10">
      <div id="user-head" class="anchor"> 
        <form class="form-horizontal" method="post" action="/settings/update-avatar" enctype="multipart/form-data" id="avatar-form">
                {{ csrf_field() }}
                <h4><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;头像设置</h4>
                <hr>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                    @if(file_exists(public_path('/images/catalog/avatar'.Auth::id().'.jpg'))) 
                       <img src="/images/catalog/avatar{{Auth::id()}}.jpg" id="avatar">
                       <img src="/images/catalog/30avatar{{Auth::id()}}.jpg" id="avatar">
                    @else
                       <img src="/images/catalog/avatardefault.jpg" id="avatar">  
                       <img src="/images/catalog/30avatardefault.jpg" id="avatar"> 
                    @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                    <button type="button" class="btn btn-primary" onclick="$('#avatarinput').click()">
                        上传新头像
                    </button>
                    <span class="loading"></span>
                    <input type="file" id="avatarinput" name="avatar" size="1" style="display: none">
                    <span class="help-block">
                        头像支持jpg和png格式，上传的文件大小不超过 2M</span>
                    <button type="submit" class="btn btn-primary hidden" id="avatarinput-submit">更新</button>
                    </div>
                </div>
            </form>
            <br><br>
      </div> 

      <div id="user-info"class="anchor">    
        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['UsersController@update',$user->name],'files' => false,'class'=>'form-horizontal']) !!} 
                <h4><i class="glyphicon glyphicon-tasks"></i>&nbsp;&nbsp;个人信息</h4>
                <hr>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">个性签名</label>
                    <div class="col-sm-6">
                    {!! Form::text('title', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="info" class="col-sm-2 control-label">个人介绍</label>
                    <div class="col-sm-6">
                        {!! Form::textarea('info', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary" id="update-user-data">更新</button>
                    </div>
                </div>
        {!! Form::close() !!}
      <br><br>
      </div>

      <div id="user-keyreset"class="anchor">         
       <form class="form-horizontal" role="form" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h4><i class="glyphicon glyphicon-wrench"></i>&nbsp;&nbsp;密码设置(建设中）</h4>
                <hr>
                <div class="form-group">
                    <label for="old_password" class="col-sm-2 control-label">当前密码</label>
                    <div class="col-sm-4">
                    <input type="password" id="old_password" name="old_password" placeholder="请输入您当前的密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password" class="col-sm-2 control-label">新密码</label>
                    <div class="col-sm-4">
                    <input type="password" id="new_password" name="new_password" placeholder="请输入新密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password" class="col-sm-2 control-label">密码确认</label>
                    <div class="col-sm-4">
                    <input type="password" id="new_password2" name="new_password2" placeholder="请再次输入新密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <label for="update-password" class="pure-checkbox">
                            <button type="button" class="btn btn-primary" id="update-password">更新
                            </button>
                            <span class="loading"></span>
                        </label>
                        <input type="hidden" name="csrf_token" value="3fc44390">
                    </div>
                </div>
            </form>
      </div>



    </div>
  </div>

@stop
