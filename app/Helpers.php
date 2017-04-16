<?php
/**
 * Created by PhpStorm.
 * User: zhaotao
 * Date: 2017/4/16
 * Time: 下午2:28
 */

function cdn($filepath)
{
    if (config('app.url_static')) {
        return config('app.url_static') . $filepath;
    } else {
        return config('app.url') . $filepath;
    }
}

function lang($text, $parameters = [])
{
    return trans('daily.'.$text, $parameters);
}

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
