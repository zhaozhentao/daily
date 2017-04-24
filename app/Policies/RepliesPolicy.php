<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/24
 * Time: 下午10:43
 */

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class RepliesPolicy
{
    use HandlesAuthorization;

    public function delete(User $currentUser, Reply $reply)
    {
        return $currentUser->id == $reply->user_id;
    }
}
