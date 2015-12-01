@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">登陆</div>
				<div class="panel-body">
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
      
					<label class="col-md-4 control-label" style = "padding-top:35px;text-align: right;">使用社交登录</label>
                    <div class="col-md-6">
						<ul class="oauth-wrap">
			              <li style="height:50px;"><a href="/auth/qq"><i class ="iconfont icon-qq" style="font-size: 50px;"></i></a></li>
			              <li style="height:50px;"><a href="/auth/weixin"><i class ="iconfont icon-weixin" style="font-size: 50px;"></i>审批中</a></li>
			              <li style="height:50px;margin-bottom:30px;"><a href="/auth/weibo"><i class ="iconfont icon-weibo" style="font-size: 50px;"></i></a></li>
			            </ul>			            
                    </div>
			        <div class="clearfix"></div><hr>

					<form class="form-horizontal" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label"style = "padding-top:24px;">或使用邮箱登录</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"style = "padding-top:24px;">密码</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="form-group">
			                      <button  style = "float:left; margin-right:30px;margin-left:15px;" type="submit" class="btn btn-primary" style="margin-right: 15px;">
			                        登陆
			                      </button>
			                      <div class="checkbox" style = "float:left;">
			                          <input type="checkbox" name="remember"><strong>记住登录</strong> 
			                      </div>
			                      <div style = "padding-top:7px;float:right;">
			                      <strong><a href="/auth/register">邮箱注册</a>
			                      &nbsp; • &nbsp;
			                      <a href="/password/email">忘记密码?</a></strong>
			                      </div>
			                    </div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
