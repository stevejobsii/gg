@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">注册</div>
				<div class="panel-body">
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

					<form class="form-horizontal" role="form" method="POST" action="/auth/register">
					  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			          <div class="form-group">
			            <label class="col-sm-3 control-label">名字</label>
			            <div class="col-sm-9">
			              <input type="text" class="form-control" name="name">
			            </div>
			          </div>

			          <div class="form-group">
			            <label class="col-sm-3 control-label">E-Mail</label>
			            <div class="col-sm-9">
			              <input type="email" class="form-control" name="email">
			            </div>
			          </div>

			          <div class="form-group">
			            <label class="col-sm-3 control-label">密码</label>
			            <div class="col-sm-9">
			              <input type="password" class="form-control" name="password">
			            </div>
			          </div>

			          <div class="form-group">
			            <label class="col-sm-3 control-label">确定密码</label>
			            <div class="col-sm-9">
			              <input type="password" class="form-control" name="password_confirmation">
			            </div>
			          </div>

			          <div class="form-group">
			            <div class = "col-sm-3"></div>
			            <div class = "col-sm-9">
			              <button type="submit" class="btn btn-primary btn-lg">
			                注册
			              </button>
			            </div>
			          </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
