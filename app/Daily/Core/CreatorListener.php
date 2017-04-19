<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/19
 * Time: 下午3:41
 */

namespace Daily\Core;


interface CreatorListener
{
    public function createSuccess($model);

    public function createFailed($error);
}
