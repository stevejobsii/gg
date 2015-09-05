  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="{{ url('articles') }}">GoodGoto好去处</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('articles') }}"><strong>所有笑图</strong></a></li>
          <li class="dropdown ">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><strong>笑图分类</strong> <span class="caret"></span></a>
           <ul class="dropdown-menu" role="menu">           
           <li >
           <a href="/tags/China/"><strong>国内图片</strong></a>
           </li>     
           <li >
           <a href="/tags/Asia/"><strong>亚洲图片</strong></a>
           </li>
           <li >
           <a href="/tags/EU/"><strong>欧美图片</strong></a>
           </li>                
           <li >
           <a href="/tags/GIF/"><strong>GIF</strong></a>
           </li>  
           </ul>
           </li>
           <li><a href="/articles/create"><strong>放图过来</strong></a></li>
           </ul>   
           <ul class="nav navbar-nav navbar-right">
           <li>
           {!!Form::open(['method'=>'GET','class'=>'inner-addon right-addon'])!!}
              <i class="glyphicon glyphicon-search"></i>
              {!!Form::input('search','q',null,['placeholder'=>'搜索','class'=>'form-control mac-style'])!!}
           {!!Form::close()!!}
           </li>
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
           <span class="glyphicon glyphicon-user">
           </span>Hello, {{Auth::user()->name}}<span class="caret"></span>
           </a>
           <ul class="dropdown-menu" role="menu">
           <li><a href="/users/{{Auth::user()->id}}/articles">
           <span class="glyphicon glyphicon-inbox"></span>
           {{Auth::user()->name}}的档案</a></li>
           <li class="divider"></li>
           <li><a href="/auth/logout"><span class="glyphicon glyphicon-remove"></span>
           <strong>退出</strong></a></li>
           </ul>
           </li>
           @else
           <li><a href="/auth/register"><span class="glyphicon glyphicon-edit"></span>
           <strong>注册</strong></a></li>
           <li><a href="/auth/login"><span class="glyphicon glyphicon-check"></span>
           <strong>登陆</strong></a></li>
           @endif
           </ul>
    </div>
  </div>
</nav>



