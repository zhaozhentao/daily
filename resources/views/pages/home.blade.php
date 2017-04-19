@extends('layouts.default')

@section('content')
    <div class="row" style="margin-top: 60px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="home-nav-container">
                        <a href="{{ route('home') }}" class="home-nav">Blog</a>
                        <a href="{{ route('aboutme') }}" class="home-nav">About Me</a>
                    </div>
                </div>
                <div class="panel-body">
                    <ul>
                        @foreach($topics as $topic)
                            <li class="home-content-item">
                                <a href="" class="home-content-title">{{ $topic->title }}</a>
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
