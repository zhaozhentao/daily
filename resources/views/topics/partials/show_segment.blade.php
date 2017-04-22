<div class="votes-container panel panel-default padding-md">
  hi
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
