<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="{{ url('articles') }}">GoodGOTO</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('articles') }}"><strong>所有笑图</strong></a></li>

      

      <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><strong>笑图分类</strong> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                
                  <li >
                    <a href="/tags/GIF/"><strong>国内图片</strong></a>
                  </li>
                
                  <li >
                    <a href="/tags/Cute/"><strong>亚洲图片</strong></a>
                  </li>
                
                  <li >
                    <a href="/tags/Girl/"><strong>欧美图片</strong></a>
                  </li>
                
                  <li >
                    <a href="/tags/WTF/"><strong>Gif</strong></a>
                  </li>  
              </ul>
            </li>
                   <li><a href="/articles/create"><strong>放图过来</strong></a></li>
         </ul>   

      <ul class="nav navbar-nav navbar-right">
      @if (! Auth::check())
        <li >
          <a href="/auth/register"><strong>注册</strong></a>
        </li>
        <li>
          <a href="/auth/login"><strong>登陆</strong></a>
        </li>
      @else
        <li>
         <strong>您好！{{Auth::user()->email}}</strong>
        </li>
        <li>     
          <a href="/auth/logout"><strong>退出</strong></a>
        </li>
      @endif
      </ul>
    </div>
  </div>
</nav>



