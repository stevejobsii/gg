<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>好去处</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ url('/css/m.css') }}">
</head>

<body>
<header class="badge-headbar headbar" data-reactid=".1.0">
    <h1 data-reactid=".1.0.0">
        <a href="http://m.9gag.com" data-reactid=".1.0.0.0">9GAG</a>
    </h1>
</header>



        @if (count($articles))
		@foreach($articles as $article)
		<span class="anchor" id="{{$article->photo}}"></span>
		<article class="post-tile badge-track-scroll"  style="margin-top: 0px;">
			    <header class = "post-title-container">
				<a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank" ><h3 class="index-article-title">{{$article->title}}
	            </h3></a>
				</header>

                <div class="post-payload badge-post-image-holder">
    			    @if($article->type == '.jpg')
    			    <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
    			    <img class="badge-post-media" src="/images/catalog/{{$article->photo}}{{$article->type}}" alt="{{$article->title}}"></a>
    			    @endif
    			    @if($article->type == '_long.jpg')
    		        <div class="long-post-wrap">
    			    <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
    			    <img class="badge-post-media" src="/images/catalog/{{$article->photo}}.jpg" alt="{{$article->title}}"></a>
    		        <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank"class="post-read-more"><i class="glyphicon glyphicon-new-window"></i>&nbsp;&nbsp;查看完整</a>       
    		        </div>
    			    @endif
    			    @if($article->type == '.mp4')
    			    <div class = "video_wrap">
    			    <h2 class="video_text">Gif</h2>
    			    <video  class="badge-post-media" width="480" style="max-height:500px;min-height:300px" loop preload="auto" >
    				  <source src="/images/catalog/{{$article->photo}}{{$article->type}}" type="video/mp4">
    				Your browser does not support the video tag.
    				</video>
    				</div>
    				@endif	 
			    </div>

                <div class="post-meta-container">
                    <a>
                        {{$article->vote_count}}&nbsp;赞&nbsp;•&nbsp;{{$article->reply_count}}&nbsp;互动
                    </a>
                </div>
			    
                <footer class="post-btn-container">
                    <ul class="pull-left">
                    </ul>
                    <ul class="pull-right">
                        <li>
                            <a class="share-menu-btn">分享给好友&朋友圈</a>
                        </li>
                    </ul>
                </footer>

		    <div class="clearfix"></div>

		</article>			      
	    <hr>
		@endforeach
	  @else
        <div class="empty-block">没有任何记录哦~~</div>
      @endif


<script type="text/javascript"src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
wx.config(<?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo','onMenuShareAppMessage',), true) ?>);
  document.querySelector('#onMenuShareAppMessage').onclick = function () {
    wx.onMenuShareAppMessage({
     title: '戳了-999下！请您不要用脚点，用手行么！', // 分享标题
    desc: 'gdws.cn', // 分享描述
    link: 'http://gdws.cn/2016gamecs/index.html', // 分享链接
    imgUrl: 'http://gdws.cn/2016gamecs/public/images/screenshot.jpg', 
      trigger: function (res) {
        // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        alert('用户点击发送给朋友');
      },
      success: function (res) {
        alert('已分享');
      },
      cancel: function (res) {
        alert('已取消');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });
    alert('已注册获取“发送给朋友”状态事件');
  };
</script>
</body>

</html>