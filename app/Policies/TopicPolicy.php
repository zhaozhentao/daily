<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    public function delete(User $currentUser, Topic $topic)
    {
        return $currentUser->id = $topic->user_id;
    }

    public function update(User $currentUser, Topic $topic)
    {
        return $currentUser->id == $topic->user_id;
    }

    public function recommend(User $currentUser, Topic $topic)
    {
        return $currentUser->id == $topic->user_id;
    }
}
