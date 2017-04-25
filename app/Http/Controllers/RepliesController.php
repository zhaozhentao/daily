<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyStoreRequest;
use App\Models\Reply;
use Daily\Core\CreatorListener;
use Auth;
use Flash;
use Redirect;
use Request;

class RepliesController extends Controller implements CreatorListener
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyStoreRequest $request)
    {
        return app('Daily\Creators\ReplyCreator')->create($this, $request->except('_token'));
    }

    public function vote($id)
    {
        $reply = Reply::findOrFail($id);
        $type = app()->make('Daily\Vote\Voter')->vote($reply);

        return response([
            'status' => 200,
            'message' => lang('Operation succeeded.'),
            'type' => $type,
        ]);
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $this->authorize('delete', $reply);
        $reply->delete();

        $reply->topic()->decrement('reply_count', 1);
        return response(['status' => 200, 'message' => lang('Operation succeeded.')]);
    }

    /**
     * ----------------------------------------
     * CreatorListener Delegate
     * ----------------------------------------
     */
    public function createSuccess($model)
    {
        Flash::success(lang('Operation succeeded.'));
        return Redirect::route('topics.show', array(Request::get('topic_id'), '#last-reply'));
    }

    public function createFailed($error)
    {
        Flash::error(lang('Operation failed.'));
        return redirect()->back();
    }
}
