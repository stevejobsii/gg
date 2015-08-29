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
  <li class="{{ $user->present()->userinfoNavActive('users.show') }}">
    <a href="{{ route('users.show', $user->id) }}" >资料</a>
  </li>
</ul>
