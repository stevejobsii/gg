<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/sweetalert/1.1.0/sweetalert.min.css" rel="stylesheet">
    <link  rel="stylesheet" href="/css/main.css">
    <meta id="token" name="token" value="{{ csrf_token() }}">

    <title>好去处GoodGoTo</title>
</head>
<body>
 <!-- Button trigger modal -->

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div style="margin: 10px 20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">登录</h4>
      </div>    
      <div class="modal-body">
        <div class="container-fluid">
                  <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label class="control-label">E-Mail 地址</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                      <label class="control-label">密码</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="remember"> Remember Me
                          </label>
                        </div>
                    </div>                   
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                          登陆
                        </button>
                        <strong>
                        &nbsp;
                        <a href="/auth/register">简单注册</a>
                        &nbsp;&nbsp; • &nbsp;&nbsp;
                        <a href="/password/email">忘记密码？</a></strong>
                    </div>
                  </form>
        </div>
      </div> 
      </div>
    </div>
  </div>
</div>
            <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
            <script src="//cdn.bootcss.com/vue/0.12.16/vue.min.js"></script>
             <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script src="//cdn.bootcss.com/vue-resource/0.1.16/vue-resource.min.js"></script>
            <script src="/js/main.js"></script>
   
    </body>
</html>
