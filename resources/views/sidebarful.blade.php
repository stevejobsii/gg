<div class="col-md-4 side-bar">
	    <script type="text/x-template" id="img-slider-template">
	    <div id="slider">
	    <input checked="" type="radio" name="slider" id="slide1" selected="false">
	    <input type="radio" name="slider" id="slide2" selected="false">
	    <input type="radio" name="slider" id="slide3" selected="false">
	    <input type="radio" name="slider" id="slide4" selected="false">
	    <div id="slides">
	      <div id="overflow">
	        <div class="inner">
	          <article>
	            <content select="img:nth-of-type(1)"></content>
	          </article>
	          <article>
	            <content select="img:nth-of-type(2)"></content>
	          </article>
	          <article>
	            <content select="img:nth-of-type(3)"></content>
	          </article>
	          <article>
	            <content select="img:nth-of-type(4)"></content>
	          </article>
	        </div> <!-- .inner -->
	      </div> <!-- #overflow -->
	    </div>
	    <br>
	    <label for="slide1"></label>
	    <label for="slide2"></label>
	    <label for="slide3"></label>
	    <label for="slide4"></label>
	    </div>
	    </script>
	<div id="side-bar-ad">
	    <img-slider>
	    <img src="/images/catalog/rock.jpg">
	    <img src="/images/catalog/grooves.jpg">
	    <img src="/images/catalog/arch.jpg">
	    <img src="/images/catalog/sunset.jpg">
	    </img-slider>
	</div>
	    <p style="text-align: center">
	    这是投放广告，联系方式QQ:401789679，现在备案中等等。
	    </p>
	    <br>
    
    <div class = "width100">
    <ul class="hot-tabs bule-line-top">	    
		<li id="tab-votes" class = "current" >热门投票</li>
		<li id="tab-replies" class ="hot_tab_last">热门评论</li>
	</ul>
	<div class="clearfix"></div>
        
        <div class = "hot-list-item hot-list-item-current" id = "list-votes">
		@foreach($hotimgs as $hot)
		<article class="list-item side-bar-hot">
	       <h3 style="margin-bottom: 10px; margin-top: 10px;"><small><a href="/users/{{$hot->user_id}}/articles">{{\App\User::find($hot->user_id)->name}}</a>的图片
		   <a href="{{ action('ArticlesController@show', [$hot->photo])}}"target="_blank" >{{$hot->title}}</a></small></h3>
		   <img src="/images/catalog/{{$hot->photo}}{{$hot->type}}" class = "side-bar-hot-img" alt="{{$hot->title}}">
	       <div class = "show_more">展开</div>
		</article>
		@endforeach
		</div>


        
        <div class = "hot-list-item" id = "list-replies">
        <br>
		@foreach($hotreplies as $hot)
		<article class="list-item side-bar-hot">
	       <h3 style="margin-bottom: 0px; margin-top: 0px;"><small><a href="/users/{{$hot->article->user_id}}/articles">{{\App\User::find($hot->article->user_id)->name}}</a>的发布
           <a href="{{ action('ArticlesController@show', [$hot->article->photo])}}"target="_blank" >{{$hot->article->title}}</a></small></h3></small></h3>
	       <h3 style="padding-bottom: 10px; margin-top: 0px; border-bottom: 1px solid #e5e5e5;"><small><a href="/users/{{$hot->user_id}}/articles">{{\App\User::find($hot->user_id)->name}}</a>	
		   回复:{{$hot->body}}</a></small></h3>
		</article>
		@endforeach
		</div>

	</div>
          
</div>