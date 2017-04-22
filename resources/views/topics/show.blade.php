@extends('layouts.default')

@section('title')
  {{ $topic->title }} | @parent
@stop

@section('content')
  <div class="col-md-8 col-md-offset-2 topics-show main-col">
    <div class="topic panel panel-default">
      <div class="infos panel-heading">
        <h1 class="panel-title topic-title">{{ $topic->title }}</h1>
      </div>

      <div class="content-body entry-content panel-body">
        @include('topics.partials.body', array('body' => $topic->body))

        <div data-lang-excellent="{{ lang('This topic has been mark as Excenllent Topic.') }}"
             data-lang-wiki="{{ lang('This is a Community Wiki.') }}" class="ribbon-container">
          @include('topics.partials.ribbon')
        </div>
      </div>

      <div class="appends-container" data-lang-append="{{ lang('Append') }}">
        @foreach($topic->appends as $index => $append)
          <div class="appends">
            <span class="meta">{{ lang('Append') }} {{ $index }} &nbsp;·&nbsp; <abbr title="{{ $append->created_at }}"
                                                                                     class="timeago">{{ $append->created_at }}</abbr></span>
            <div class="sep5"></div>
            <div class="markdown-reply append-content">
              {!! $append->content !!}
            </div>
          </div>
        @endforeach
      </div>

      @include('topics.partials.topic_operate')
    </div>
    @include('topics.partials.show_segment')
  </div>
@stop
