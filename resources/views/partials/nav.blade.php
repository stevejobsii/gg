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
           {!!Form::open(['method'=>'GET'])!!}
              {!!Form::input('search','q',null,['placeholder'=>'搜索','class'=>'navbar-form'])!!}
           {!!Form::close()!!}
           </li>
           @if (Auth::check())
           <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
           Hello, {{Auth::user()->name}}<span class="caret"></span>
           </a>
           <ul class="dropdown-menu" role="menu">
           <li><a href="#">Another action</a></li>
           <li class="divider"></li>
           <li><a href="/auth/logout"><strong>退出</strong></a></li>
           </ul>
           </li>
           @else
           <li><a href="/auth/register"><strong>注册</strong></a></li>
           <li><a href="/auth/login"><strong>登陆</strong></a></li>
           @endif
           </ul>
    </div>
  </div>
</nav>



