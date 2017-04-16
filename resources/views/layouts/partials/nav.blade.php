<div role="navigation" class="navbar navbar-default topnav">
    <div class="container">
        <div class="navbar-right">
            <ul class="nav navbar-nav github-login">
                @if(Auth::check())

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
