<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/23
 * Time: 上午9:59
 */

namespace Daily\Presenters;

use Laracasts\Presenter\Presenter;
use Input;
use Config;

class TopicPresenter extends Presenter
{
    public function replyFloorFromIndex($index)
    {
        $index += 1;
        $current_page = Input::get('page') ?: 1;
        return ($current_page - 1) * Config::get('daily.replies_perpage') + $index;
    }
}
