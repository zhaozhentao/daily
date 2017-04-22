<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Models\Append;
use App\Models\Topic;
use Daily\Core\CreatorListener;
use Daily\Handler\Exception\ImageUploadException;
use Daily\Markdown\Markdown;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class TopicsController extends Controller implements CreatorListener
{
    public function show($id)
    {
        $topic = Topic::find($id);

        return view('topics.show', compact('topic'));
    }

    public function create()
    {
        return view('topics.create_edit');
    }

    public function store(Request $request)
    {
        return app()->make('Daily\Creators\TopicCreator')->create($this, $request->except('_token'));
    }

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorize('update', $topic);

        $topic->body = $topic->body_original;
        return view('topics.create_edit', compact('topic'));
    }

    public function append($id, Request $request)
    {
        $topic = Topic::findOrFail($id);
        $this->authorize('append', $topic);

        $markdown = new Markdown;
        $content = $markdown->convertMarkdownToHtml($request->input('content'));

        $append = Append::create(['topic_id' => $topic->id, 'content' => $content]);

        return response([
            'status' => 200,
            'message' => lang('Operation succeeded.'),
            'append' => $append
        ]);
    }

    public function update($id, StoreTopicRequest $request)
    {
        $topic = Topic::findOrFail($id);
        $this->authorize('update', $topic);

        $data = $request->only(['title', 'body']);
        $data['body_original'] = $data['body'];
        $data['body'] = (new Markdown())->convertMarkdownToHtml($data['body_original']);
        $data['excerpt'] = Topic::makeExcerpt($data['body']);

        $topic->update($data);
        Flash::success(lang('Operation succeeded.'));

        return redirect(route('topics.show', $id));
    }

    /**
     * ----------------------------------------
     * Admin Topic Management
     * ----------------------------------------
     */
    public function recommend($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorize('recommend', $topic);
        $topic->is_excellent = $topic->is_excellent == 'yes' ? 'no' : 'yes';
        $topic->save();

        return response(['status' => 200, 'message' => lang('Operation succeeded.')]);
    }

    public function pin($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorize('pin', $topic);

        $topic->order = $topic->order > 0 ? 0 : 999;
        $topic->save();

        return response(['status' => 200, 'message' => lang('Operation succeeded.')]);
    }

    public function sink($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorize('sink', $topic);

        $topic->order = $topic->order >= 0 ? -1 : 0;
        $topic->save();

        return response(['status' => 200, 'message' => lang('Operation succeeded.')]);
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $this->authorize('delete', $topic);
        $topic->delete();

        Flash::success(lang('Operation succeeded.'));

        return redirect(route('home'));
    }

    public function uploadImage(Request $request)
    {
        if ($file = $request->file('file')) {
            try {
                $upload_status = app('Daily\Handler\UploadImageHandler')->uploadImage($file);
            } catch (ImageUploadException $exception) {
                return ['error' => $exception->getMessage()];
            }
            $data['filename'] = $upload_status['filename'];
        } else {
            $data['error'] = 'Error while uploading file';
        }

        return $data;
    }

    /**
     * ----------------------------------------
     * CreatorListener implements
     * ----------------------------------------
     */
    public function createSuccess($model)
    {
        return redirect()->route('topics.show', $model->id);
    }

    public function createFailed($error)
    {
        return redirect('/');
    }
}
