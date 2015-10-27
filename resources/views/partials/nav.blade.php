  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ url('articles') }}">GoodGoto好去处</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav hoverwhite">
           <li><a href="{{ url('articles') }}"><strong><i class="glyphicon glyphicon-picture" aria-hidden="true"></i>&nbsp;&nbsp;热门图片</strong></a></li>
           <li><a href="{{ url('articles/create') }}"><strong><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>&nbsp;&nbsp;投稿</strong></a></li>
           <li><a href="{{ url('guestbook') }}"><strong><i class="glyphicon glyphicon-comment" aria-hidden="true"></i>&nbsp;&nbsp;留言板</strong></a></li>
           <li class="dropdown ">
             <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong><i class="glyphicon glyphicon-tags" aria-hidden="true"></i>&nbsp;&nbsp;标签</strong> <span class="caret"></span></a>
               <ul class="dropdown-menu" role="menu">           
               <li >
               <a href="{{ url('tags/China') }}"><strong>国内图片</strong></a>
               </li>     
               <li >
               <a href="{{ url('tags/Asia') }}"><strong>亚洲图片</strong></a>
               </li>
               <li >
               <a href="{{ url('tags/EU') }}"><strong>欧美图片</strong></a>
               </li>                
               <li >
               <a href="{{ url('tags/GIF') }}"><strong>GIF</strong></a>
               </li>  
               </ul>
           </li>

           <li><a href="javascript:void(0)" class="dropdown-toggle" id="nav-search"><strong><i class="glyphicon glyphicon-search" aria-hidden="true"></i>&nbsp;&nbsp;搜索</strong> <span class="caret"></span></a>
           <div class = "nav-search">
           {!!Form::open(['method'=>'GET','class'=>'inner-addon  form-control-nav right-addon'])!!}
              <i class="glyphicon glyphicon-search"aria-hidden="true"></i>
              {!!Form::input('search','q',null,['placeholder'=>'搜索','class'=>'form-control'])!!}
           {!!Form::close()!!}
           </div>
           </li>
      </ul>   

      <ul class="nav navbar-nav navbar-right">          
        @if (Auth::check())
         <li>
            <a href="{{ route('notifications.index') }}" class="text-warning"> 
            <span class="badge-notification-count">          
                    {{ Auth::user()->notification_count }} 
            </span>          
            </a>
         </li>
         
         <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         <span class="glyphicon glyphicon-user" aria-hidden="true">
         </span>{{Auth::user()->name}}<span class="caret"></span>
         </a>
      
         <ul class="dropdown-menu" role="menu">
         <li><a href="/users/{{Auth::user()->id}}/articles" >
         <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
         我的档案</a></li>
         <li class="divider"></li>
         

         <li><a id="bookmark-link" v-on="click : getbookmark" href="javascript:void(0)">
         <span class="glyphicon glyphicon-bookmark"aria-hidden="true"></span>
         续看书签</a></li>
         
         <li class="divider"></li>
         <li><a href="/auth/logout"><span class="glyphicon glyphicon-remove"aria-hidden="true"></span>
         <strong>退出</strong></a></li>
         </ul>
         </li>
        
        @else        
         <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModalregister"><span class="glyphicon glyphicon-edit"aria-hidden="true"></span>
         <strong>简单注册</strong></a></li>
         <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModallogin"><span class="glyphicon glyphicon-check"aria-hidden="true"></span>
         <strong>登陆</strong></a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<!-- Modal signup-->
<div class="modal fade" id="myModallogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <button type="submit" class="btn btn-primary btn-lg" style="margin-right: 15px;">
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

<!-- Modal signup-->
<div class="modal fade" id="myModalregister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">     
      <div style="margin: 10px 20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">简单注册</h4>
      </div>    
      <div class="modal-body">
        <div class="container-fluid">
              <form class="form-horizontal" role="form" method="POST" action="/auth/register">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                    <label class="col-sm-3 control-label">名字</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">E-Mail</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" name="email" value="{{ old('email') }}">
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
</div>


