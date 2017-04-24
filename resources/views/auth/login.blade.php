@extends('layouts.default')

@section('title')
    用户登录 | @parent
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">登录</h3>
                </div>
                <div class="panel-body">
                    <a class="btn btn-lg btn-default btn-block" id="login-required-submit"
                       href="{{ URL::route('auth.oauth', ['driver' => 'github']) }}"><i
                                class="fa fa-github-alt"></i> {{lang('Login with GitHub')}}</a>
                    <a class="btn btn-lg btn-default btn-block"
                       href="{{ URL::route('auth.oauth', ['driver' => 'wechat']) }}"><i
                                class="fa fa-weixin"></i> {{lang('Login with WeChat')}}</a>
                </div>
            </div>
        </div>
    </div>
@stop
