<nav class="navbar navbar-default">
  <div class="container nav-container">
    <div class="container-fluid">
      <div class="navbar-header {{Auth::check()? '':'mobile-navbar-header' }}">
        <a class="navbar-brand" href="{{ route('home') }}" style="color: #f36c60; font-weight: bold; font-size: 22px;">
          Daily
        </a>
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
            @include('layouts.partials.nav_menu_item')
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
                @include('layouts.partials.nav_menu_item')
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
</nav>
