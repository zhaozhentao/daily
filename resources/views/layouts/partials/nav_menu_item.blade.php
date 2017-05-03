<li>
  <a href="{{ route('users.show', Auth::user()->id) }}">
    <i class="fa fa-user-circle text-md nav-menu-icon"></i> 个人中心
  </a>
</li>
@if(Auth::user()->can('manage_topics'))
  <li>
    <a href="{{ route('topics.create') }}">
      <i class="fa fa-edit text-md nav-menu-icon"></i> 日志
    </a>
  </li>
@endif
<li>
  <a href="{{ URL::route('logout') }}"
     data-lang-loginout="{{ lang('Are you sure want to logout?') }}">
    <i class="fa fa-sign-out text-md nav-menu-icon"></i> {{ lang('Logout') }}
  </a>
</li>

