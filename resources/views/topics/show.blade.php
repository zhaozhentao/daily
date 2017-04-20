@extends('layouts.default')

@section('title')
    {{ $topic->title }} | @parent
@stop

@section('content')
    <div class="col-md-9 topics-show main-col">
        <div class="topic panel panel-default">
            <div class="infos panel-heading">
                <h1 class="panel-title topic-title">{{ $topic->title }}</h1>
            </div>

            <div class="content-body entry-content panel-body">
                @include('topics.partials.body', array('body' => $topic->body))
            </div>
        </div>
    </div>
@stop
