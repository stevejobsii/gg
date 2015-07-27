<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('articles') }}">博客</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('articles') }}">所有文章</a></li>

      

      <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">文章分类标签 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                
                  <li >
                    <a href="/tags/GIF/">GIF</a>
                  </li>
                
                  <li >
                    <a href="/tags/Cute/">Cute</a>
                  </li>
                
                  <li >
                    <a href="/tags/Girl/">Girl</a>
                  </li>
                
                  <li >
                    <a href="/tags/WTF/">WTF</a>
                  </li>  
              </ul>
            </li>
                   <li><a href="/articles/create">创建文章</a></li>
         </ul>   

      <ul class="nav navbar-nav navbar-right">
         <li >
          <a href="/auth/register">注册</a>
        </li>
        <li>
          <a href="/auth/login">登陆</a>
        </li>
        <li>
          <a href="/auth/logout">注销</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



