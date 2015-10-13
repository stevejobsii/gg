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
        <li><a href="{{ url('articles') }}"><strong><i class="glyphicon glyphicon-picture"></i>&nbsp;&nbsp;热门图片</strong></a></li>
           <li><a href="{{ url('articles/create') }}"><strong><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;投稿</strong></a></li>
           <li><a href="{{ url('guestbook') }}"><strong><i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;留言板</strong></a></li>
           <li class="dropdown ">
             <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><strong><i class="glyphicon glyphicon-tags"></i>&nbsp;&nbsp;标签</strong> <span class="caret"></span></a>
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
           <li><a href="javascript:void(0)" class="dropdown-toggle" id="nav-search"><strong><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;搜索</strong> <span class="caret"></span></a>
           <div class = "nav-search">
           {!!Form::open(['method'=>'GET','class'=>'inner-addon  form-control-nav right-addon'])!!}
              <i class="glyphicon glyphicon-search"></i>
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
           <span class="glyphicon glyphicon-user">
           </span>{{Auth::user()->name}}<span class="caret"></span>
           </a>
           <ul class="dropdown-menu" role="menu">
           <li><a href="/users/{{Auth::user()->id}}/articles" >
           <span class="glyphicon glyphicon-inbox"></span>
           我的档案</a></li>
           <li class="divider"></li>
           

           <li><a id="bookmark-link" v-on="click : getbookmark" href="javascript:void(0)">
           <span class="glyphicon glyphicon-bookmark"></span>
           续看书签</a></li>
           
           <li class="divider"></li>
           <li><a href="/auth/logout"><span class="glyphicon glyphicon-remove"></span>
           <strong>退出</strong></a></li>
           </ul>
           </li>
           @else
           <li><a href="/auth/register"><span class="glyphicon glyphicon-edit"></span>
           <strong>简单注册</strong></a></li>
           <li><a href="/auth/login"><span class="glyphicon glyphicon-check"></span>
           <strong>登陆</strong></a></li>
           @endif
           </ul>
    </div>
  </div>
</nav>



