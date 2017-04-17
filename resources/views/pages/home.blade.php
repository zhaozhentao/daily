@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="home-nav-container">
                        <a href="" class="home-nav">Blog</a>
                        <a href="" class="home-nav">About Me</a>
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
                </div>
            </div>
        </div>
    </div>
@stop
