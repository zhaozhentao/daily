<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/22
 * Time: 下午11:08
 */

namespace App\Http\Requests;


class ReplyStoreRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => 'required|min:2',
        ];
    }
}
