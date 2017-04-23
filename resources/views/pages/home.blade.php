@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default" style="position: relative;overflow: hidden; box-shadow: 0 1px 2px 0 rgba(0,0,0,.2);">
        <div class="panel-heading">
          <div class="home-nav-container">
            <a href="{{ route('home') }}" class="home-nav">Blog</a>
            <a href="{{ route('aboutme') }}" class="home-nav">About Me</a>
          </div>
        </div>
        <div class="panel-body">
          <ul style="padding-left: 40px; padding-right: 40px">
            @foreach($topics as $topic)
              <li class="home-content-item">
                <a href="{{ route('topics.show', $topic->id) }}" class="home-content-title">{{ $topic->title }}</a>
                <small class="home-content-time">{{ $topic->created_at }}</small>
              </li>
            @endforeach
          </ul>
          <div style="float: right">
            {!! $topics->render() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
