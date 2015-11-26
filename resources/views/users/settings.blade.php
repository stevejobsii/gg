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

    <nav class="col-md-2 hidden-xs hidden-sm" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked">
      <h3>用户中心</h3>
        <li class="active"><a href="#user-head">头像设置</a></li>
        <li><a href="#user-info">个人信息</a></li>
        <li><a href="#user-keyreset">密码设置</a></li>
      </ul>
    </nav>

    <div class="col-md-10">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> 你的输入有误<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <div id="user-head" > 
        <form class="form-horizontal" method="post" action="/settings/update-avatar" enctype="multipart/form-data" id="avatar-form">
                {{ csrf_field() }}
                <h4><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;头像设置</h4>
                <hr>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                    @if(file_exists(public_path('/images/avatar/avatar'.Auth::id().'.jpg'))) 
                       <img src="/images/avatar/avatar{{Auth::id()}}.jpg" id="avatar">
                       <img src="/images/avatar/30avatar{{Auth::id()}}.jpg" id="avatar">
                    @else
                       <img src="/images/avatar/avatardefault.jpg" id="avatar">  
                       <img src="/images/avatar/30avatardefault.jpg" id="avatar"> 
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

      <div id="user-info">    
        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['UsersController@update',$user->name],'files' => false,'class'=>'form-horizontal']) !!} 
                <h4><i class="glyphicon glyphicon-tasks"></i>&nbsp;&nbsp;个人信息</h4>
                <hr>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">用户名字</label>
                    <div class="col-sm-6">
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
          
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">电子邮箱</label>
                    <div class="col-sm-6">
                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                    </div>
                </div>

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

      <div id="user-keyreset"> 
       @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
        @endif        
        <form class="form-horizontal" method="post" action="/settings/resetPassword" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h4><i class="glyphicon glyphicon-wrench"></i>&nbsp;&nbsp;密码设置</h4>
                <hr>
                <div class="form-group">
                    <label for="old_password" class="col-sm-2 control-label">当前密码</label>
                    <div class="col-sm-4">
                    <input type="password" name="old_password" placeholder="请输入您当前的密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password" class="col-sm-2 control-label">新密码</label>
                    <div class="col-sm-4">
                    <input type="password" name="password" placeholder="请输入新密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password" class="col-sm-2 control-label">密码确认</label>
                    <div class="col-sm-4">
                    <input type="password" name="password_confirmation" placeholder="请再次输入新密码" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <label for="update-password" class="pure-checkbox">
                            <button type="submit" class="btn btn-primary" id="update-password">更新
                            </button>
                        </label>
                    </div>
                </div>
            </form>
      </div>
    </div>

@stop
