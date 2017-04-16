<?php

namespace App\Models\Traits;

use App\Models\User;

/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/16
 * Time: 下午10:54
 */
trait UserSocialiteHelper
{
    public static function getByDriver($driver, $id)
    {
        $functionMap = [
            'github' => 'getByGithubId',
            'wechat' => 'getByWeChatId',
        ];
        $function = $functionMap[$driver];
        if (!$function) {
            return null;
        }
        return self::$function($id);
    }

    public static function getByGithubId($id)
    {
        return User::where('github_id', '=', $id)->first();
    }

    public static function getByWeChatId($id)
    {

    }
}
