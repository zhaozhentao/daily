<?php

namespace Daily\Listeners;

/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/17
 * Time: 上午7:00
 */
interface UserCreatorListener
{
    public function userValidationError($errors);

    public function userCreated($user);
}
