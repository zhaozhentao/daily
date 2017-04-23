<div class="votes-container panel panel-default padding-md">
  hi
</div>

<!-- Reply List -->
<div class="replies panel panel-default list-panel replies-index">
  <div class="panel-heading">
    <div class="total">{{ lang('Total Reply Count') }}: <b>{{ $replies->total() }}</b></div>
  </div>

  <div class="panel-body">
    @if (count($replies))
      @include('topics.partials.replies', ['manage_topics' => $currentUser ? $currentUser->can("manage_topics") : false])
      <div id="replies-empty-block" class="empty-block hide">{{ lang('No comments') }}~~</div>
    @else
      <ul class="list-group row"></ul>
      <div id="replies-empty-block" class="empty-block">{{ lang('No comments') }}~~</div>
    @endif
  </div>
</div>

<!-- Reply Box -->
<div class="reply-box form box-block">
  <form method="post" action="{{route('replies.store')}}" accept-charset="UTF-8" id="reply-form">
    {!! csrf_field() !!}
    <input type="hidden" name="topic_id" value="{{ $topic->id }}"/>

    <div class="form-group">
      @if ($currentUser)
        @if ($currentUser->verified)
          <textarea class="form-control" rows="5" placeholder="{{ lang('Please using markdown.') }}"
                    style="overflow:hidden" id="reply_content" name="body" cols="50"></textarea>
        @else
          <textarea class="form-control" disabled="disabled" rows="5"
                    placeholder="{{ lang('You need to verify the email for commenting.') }}" name="body"
                    cols="50"></textarea>
        @endif
      @else
        <textarea class="form-control" disabled="disabled" rows="5"
                  placeholder="{{ lang('User Login Required for commenting.') }}" name="body" cols="50"></textarea>
      @endif
    </div>

    <div class="form-group reply-post-submit">
      <input class="btn btn-primary {{ $currentUser ? '' :'disabled'}}" id="reply-create-submit" type="submit"
             value="{{ lang('Reply') }}">
      <span class="help-inline" title="Or Command + Enter">Ctrl+Enter</span>
    </div>

    <div class="box preview markdown-reply" id="preview-box" style="display:none;"></div>

  </form>
</div>
