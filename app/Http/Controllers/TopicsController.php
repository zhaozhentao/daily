<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Daily\Core\CreatorListener;
use Daily\Handler\Exception\ImageUploadException;
use Illuminate\Http\Request;

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

    public function createSuccess($model)
    {
        return redirect()->route('topics.show', $model->id);
    }

    public function createFailed($error)
    {
        return redirect('/');
    }
}
