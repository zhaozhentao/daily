<?php

namespace Daily\Creators;

use App\Models\User;
use Daily\Listeners\UserCreatorListener;

/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/17
 * Time: 上午6:54
 */
class UserCreator
{
    public function create(UserCreatorListener $createListener, $userData)
    {
        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);
        if (!$user) {
            return $createListener->userValidationError($user->getError());
        }
        $user->cacheAvatar();
        return $createListener->userCreated($user);
    }
}
