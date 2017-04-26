<div role="navigation" class="navbar navbar-default topnav">
  <div class="container">
    <div class="navbar-left">
      <a href="{{ route('home') }}" class="logo" style="line-height: 25px; font-size: 22px; color: #f36c60;">
        <b>
          Daily
        </b>
      </a>
    </div>
    <div class="navbar-right">
      <ul class="nav navbar-nav github-login">
        @if(Auth::check())
          <li>
            <a href="#" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
               id="dLabel">
              <img src="{{ $currentUser->present()->gravatar }}" class="avatar-topnav">
              {{ $currentUser->name }}
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
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
            </ul>
          </li>
        @else
          <a href="{{ URL::route('auth.login') }}" class="btn btn-primary login-btn">
            <i class="fa fa-user"></i>
            {{ lang('Login') }}
          </a>
        @endif
      </ul>
    </div>
  </div>
</div>
