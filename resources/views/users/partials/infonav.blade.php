
<div class="avatar-container">
@if(file_exists(public_path('/images/catalog/avatar'.$user->id.'.jpg'))) 
   <img src="/images/catalog/avatar{{$user->id}}.jpg" id="avatar">  
@else
   <img src="/images/catalog/avatardefault.jpg" id="avatar">  
@endif
</div>


<br><br><br><br><br><h5 style="text-align: center;">{{$user->name}}的收藏<small>（{{$user->title}}）</small></h5>
<h5 style="text-align: center;"><small>个人简介：{{$user->info}}</small></h5>

<ul class="nav nav-tabs user-info-nav" role="tablist">
  <li class="{{ $user->present()->userinfoNavActive('users.articles') }}">
  	<a href="{{ route('users.articles', $user->id) }}" >上传</a>
  </li>
  <li class="{{ $user->present()->userinfoNavActive('users.replies') }}">
  	<a href="{{ route('users.replies', $user->id) }}" >评论</a>
  </li>
  <li class="{{ $user->present()->userinfoNavActive('users.upvotes') }}">
  	<a href="{{ route('users.upvotes', $user->id) }}" >点赞</a>
  </li>
</ul>
<br>
