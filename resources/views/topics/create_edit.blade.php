@extends('layouts.default')

@section('content')
  <div class="col-md-8 col-md-offset-2">
    @if(isset($topic))
      <form action="{{ route('topics.update', $topic->id) }}" accept-charset="UTF-8" id="topic_edit_form" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        @else
          <form action="{{ route('topics.store') }}" accept-charset="UTF-8" id="topic_create_form" method="POST">
            @endif
            {!! csrf_field() !!}
            <div class="form-group">
              <input type="text" class="form-control" placeholder="{{ lang('Please write down a topic') }}"
                     name="title" required="required"
                     value="{{ !isset($topic) ? '' : $topic->title }}">
            </div>
            <div class="form-group">
                <textarea required="require" class="form-control" rows="20" style="overflow:hidden" id="reply_content"
                          placeholder="{{ lang('Please using markdown.') }}" name="body"
                          cols="50">{{ !isset($topic) ? '' : $topic->body_original }}</textarea>
            </div>

            <div class="form-group status-post-submit">
              <input class="btn btn-primary" id="topic-submit" type="submit" value="{{ lang('Publish') }}">
            </div>
            @if(isset($topic))
          </form>
          @else
      </form>
    @endif
  </div>
@stop

@section('scripts')

  <link rel="stylesheet" href="{{ cdn(elixir('assets/css/editor.css')) }}">
  <script src="{{ cdn(elixir('assets/js/editor.js')) }}"></script>

  <script type="text/javascript">

      $(document).ready(function () {
          var simplemde = new SimpleMDE({
              spellChecker: false,
              autosave: {
                  enabled: {{ isset($topic) ? 'false' : 'true' }},
                  delay: 1000,
                  unique_id: "topic_content{{ isset($topic) ? $topic->id : '' }}"
              },
              forceSync: true
          });

          inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
              uploadUrl: Config.routes.upload_image,
              extraParams: {
                  '_token': Config.token,
              },
              onFileUploadResponse: function (xhr) {
                  var result = JSON.parse(xhr.responseText),
                      filename = result[this.settings.jsonFieldName];

                  if (result && filename) {
                      var newValue;
                      if (typeof this.settings.urlText === 'function') {
                          newValue = this.settings.urlText.call(this, filename, result);
                      } else {
                          newValue = this.settings.urlText.replace(this.filenameTag, filename);
                      }
                      var text = this.editor.getValue().replace(this.lastValue, newValue);
                      this.editor.setValue(text);
                      this.settings.onFileUploaded.call(this, filename);
                  }
                  return false;
              }
          });
      });


  </script>
@stop
