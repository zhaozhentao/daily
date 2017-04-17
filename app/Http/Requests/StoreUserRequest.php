<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/17
 * Time: 上午6:38
 */

namespace App\Http\Requests;


class StoreUserRequest extends Request
{
    public function rules()
    {
        return [
            'github_id' => 'unique:users',
            'github_name' => 'string',
            'wechat_openid' => 'string',
            'name' => 'alpha_num|required|unique:users',
            'email' => 'email|required|unique:users',
            'github_url' => 'url',
            'image_url' => 'url',
            'wechat_unionid' => 'string',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
