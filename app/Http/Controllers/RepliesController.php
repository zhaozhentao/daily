<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyStoreRequest;
use Daily\Core\CreatorListener;
use Auth;
use Flash;
use Redirect;
use Request;

class RepliesController extends Controller implements CreatorListener
{
    public function store(ReplyStoreRequest $request)
    {
        return app('Daily\Creators\ReplyCreator')->create($this, $request->except('_token'));
    }

    public function createSuccess($model)
    {
        Flash::success(lang('Operation succeeded.'));
        return Redirect::route('topics.show', array(Request::get('topic_id'), '#last-reply'));
    }

    public function createFailed($error)
    {

    }
}
