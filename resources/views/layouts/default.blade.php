<!--
______                            _              _______     _______    _______
| ___ \                          | |            |_____  |   |_____  |  |__   __|
| |_/ /___ __      __ ___  _ __  | |__   _   _       / /         / /      | |
|  __// _ \\ \ /\ / // _ \| '__| | '_ \ | | | |    / /         / /        | |
| |  | (_) |\ V  V /|  __/| |    | |_) || |_| |  / /____     / /____      | |
\_|   \___/  \_/\_/  \___||_|    |_.__/  \__, | \______/    \______/      |_|
                                          __/ |
                                         |___/
  ========================================================
  Powered by zzt
-->
<!DOCTYPE html>
<html>
<head>
    <title>@section('title') Daily @show - Powered by PHPHub</title>

    <link rel="stylesheet" href="{{ cdn(elixir('assets/css/styles.css')) }}">
</head>
<body id="body" class="{{ route_class() }}">

<div id="wrap">
    @include('layouts.partials.nav')

    <div class="container main-container">
        @yield('content')
    </div>
</div>

<script src="{{ cdn(elixir('assets/js/scripts.js')) }}"></script>
</body>
</html>
