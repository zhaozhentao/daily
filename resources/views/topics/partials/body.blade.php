<div class="markdown-body" id="emojify">
  {!! $body !!}

  @if($topic->user->signature)
    <div class="signature">
      <a class="popover-with-html" data-content="作者署名" target="_blank"
         style="color: #ccc;" href="https://laravel-china.org/topics/3422">
        <i class="fa fa-paw" aria-hidden="true"></i>
        <span style="display: inline-block; margin-left: 8px;">
          {!! $topic->user->present()->formattedSignature() !!}
        </span>
      </a>
    </div>
  @endif

</div>
