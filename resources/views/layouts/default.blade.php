<!--
______                            _              _______  _______  _______
| ___ \                          | |            |_____  ||_____  ||__   __|
| |_/ /___ __      __ ___  _ __  | |__   _   _       / /      / /    | |
|  __// _ \\ \ /\ / // _ \| '__| | '_ \ | | | |    / /      / /      | |
| |  | (_) |\ V  V /|  __/| |    | |_) || |_| |  / /____  / /____    | |
\_|   \___/  \_/\_/  \___||_|    |_.__/  \__, | \______/ \______/    |_|
                                          __/ |
                                         |___/
  ========================================================
  Powered by zzt
-->
<!DOCTYPE html>
<html>
<head>
  <title>@section('title') Daily @show</title>

  <link rel="stylesheet" href="{{ cdn(elixir('assets/css/styles.css')) }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

  <meta name="_token" content="{{ csrf_token() }}">
  <script>
      Config = {
          'cdnDomain': '{{ get_cdn_domain() }}',
          'user_id': {{ $currentUser ? $currentUser->id : 0 }},
          'user_avatar': {!! $currentUser ? '"'.$currentUser->present()->gravatar() . '"' : '""' !!},
          'user_link': {!! $currentUser ? '"'. route('users.show', $currentUser->id) . '"' : '""' !!},
          'routes': {
              'upload_image': '{{ route('upload_image') }}'
          },
          'token': '{{ csrf_token()}}',
          'environment': '{{ app()->environment() }}',
          'following_users': []
      };

      var ShowCrxHint = '{{isset($show_crx_hint) ? $show_crx_hint : 'no'}}';
  </script>
</head>

<body id="body" class="{{ route_class() }}">

<div id="wrap">
  @include('layouts.partials.nav')

  <div class="container main-container">
    @include('flash::message')
    @yield('content')
  </div>
</div>

<script src="{{ cdn(elixir('assets/js/scripts.js')) }}"></script>

@yield('scripts')

</body>
</html>
