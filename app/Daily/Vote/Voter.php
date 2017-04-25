<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/25
 * Time: 上午8:46
 */

namespace Daily\Vote;

use App\Models\Reply;
use Auth;

class Voter
{
    public function vote(Reply $reply)
    {
        if (Auth::id() == $reply->user_id) {
            return;
        }

        if ($reply->votes()->ByWho(Auth::id())->WithType('upvote')->count() > 0) {
            $action = 'downvote';
            $actionType = 'sub';
            $reply->decrement('vote_count', 1);
        } else {
            $action = 'upvote';
            $actionType = 'add';
            $reply->increment('vote_count', 1);
        }
        $reply->votes()->updateOrCreate(['user_id' => Auth::id()], ['is' => $action, 'user_id' => 1]);
        return $actionType;
    }
}
