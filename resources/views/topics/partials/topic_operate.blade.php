<div class="panel-footer operate">
  <div class="pull-left hidden-xs">
    <div class="social-share-cs "></div>
  </div>

  <div class="pull-right actions">
    <a data-ajax="post" id="topic-recomend-button" href="javascript:void(0);"
       data-url="{{ route('topics.recommend', [$topic->id]) }}"
       class="admin popover-with-html {{ $topic->is_excellent == 'yes' ? 'active' : ''}}"
       data-content="推荐主题，加精的帖子会出现在首页">
      <i class="fa fa-trophy"></i>
    </a>

    @if ($topic->order >= 0)
      <a data-ajax="post" id="topic-pin-button" href="javascript:void(0);"
         data-url="{{ route('topics.pin', [$topic->id]) }}"
         class="admin popover-with-html {{ $topic->order > 0 ? 'active' : '' }}" data-content="帖子置顶，会在列表页置顶">
        <i class="fa fa-thumb-tack"></i>
      </a>
    @endif

    @if ($topic->order <= 0)
      <a data-ajax="post" id="topic-sink-button" href="javascript:void(0);"
         data-url="{{ route('topics.sink', [$topic->id]) }}"
         class="admin popover-with-html {{ $topic->order < 0 ? 'active' : '' }}" data-content="沉贴，帖子将会被降低排序优先级">
        <i class="fa fa-anchor"></i>
      </a>
    @endif

    @if($currentUser->id && $currentUser->id == $topic->user_id)
      <a data-method="delete" id="topic-delete-button" href="javascript:void(0);"
         data-url="{{ route('topics.destroy', [$topic->id]) }}" data-content="{{ lang('Delete') }}"
         class="admin  popover-with-html">
        <i class="fa fa-trash-o"></i>
      </a>

      <a id="topic-edit-button"
         href="{{ isset($is_article) ?  route('articles.edit', [$topic->id]) : route('topics.edit', [$topic->id]) }}"
         data-content="{{ lang('Edit') }}" class="admin  popover-with-html no-pjax">
        <i class="fa fa-pencil-square-o"></i>
      </a>
    @endif

  </div>
  <div class="clearfix"></div>

</div>
