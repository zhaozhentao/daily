<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/22
 * Time: 上午7:06
 */

namespace App\Http\Requests;


class StoreTopicRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:2',
            'body' => 'required|min:2',
        ];
    }
}
