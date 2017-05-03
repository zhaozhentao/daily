<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header {{Auth::check()? '':'mobile-navbar-header' }}">
      <a class="navbar-brand" href="{{ route('home') }}" style="color: #f36c60; font-weight: 600;">Daily</a>
      @if(Auth::check())
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      @endif
    </div>

    @if(Auth::check())
      <div class="collapse navbar-collapse nav-user-menu nav-mobile-menu" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
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
      </div>
    @endif

    <div class="navbar-right {{ Auth::check()? 'nav-user-menu-desktop': '' }}">
      <ul class="nav navbar-nav github-login nav-right-item">
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
</nav>
