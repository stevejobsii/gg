<div style="text-align: center;">
  <a href="">
    <img src="" class="img-thumbnail users-show-avatar" style="width: 206px;margin: 4px 4px 15px;min-height:190px">
  </a>
</div>

<dl class="dl-horizontal">

  <dt><lable>&nbsp; </lable></dt><dd>User ID: {{ $user->id }}</dd>

  <dt><label>Name:</label></dt><dd><strong>{{{ $user->name }}}</strong></dd>


@if ($currentUser && ($currentUser->id == $user->id || Entrust::can('manage_users')))
  <a class="btn btn-primary btn-block" href="{{ route('users.edit', $user->id) }}" id="user-edit-button">
    <i class="fa fa-edit"></i> {{ lang('Edit Profile') }}
  </a>
@endif

@if ($currentUser && Entrust::can('manage_users') && ($currentUser->id != $user->id))
  <a data-method="post" class="btn btn-{{ $user->is_banned ? 'warning' : 'danger' }} btn-block" href="javascript:void(0);" data-url="{{ route('users.blocking', $user->id) }}" id="user-edit-button" onclick=" return confirm('{{ lang('Are you sure want to '. ($user->is_banned ? 'unblock' : 'block') . ' this User?') }}')">
    <i class="fa fa-times"></i> {{ $user->is_banned ? lang('Unblock User') : lang('Block User') }}
  </a>
@endif
