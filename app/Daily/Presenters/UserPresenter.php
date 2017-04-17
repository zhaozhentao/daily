<?php

namespace Daily\Presenters;

use Laracasts\Presenter\Presenter;

/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/17
 * Time: 下午9:35
 */
class UserPresenter extends Presenter
{
    public function gravatar($size = 100)
    {
        if (config('app.url_static') && $this->avatar) {
            $postfix = $size > 0 ? "?imageView2/1/w/{$size}/h/{$size}" : '';
            return cdn('uploads/avatars/' . $this->avatar) . $postfix;
        }
    }
}
