<?php
namespace app\index\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'pass'   => 'require|max:32|min:6',
        'reps'   => 'require|confirm:pass',
	    'email'  => 'require',
    ];

    protected $message = [
        'email.require'   => '请填写学号!',
        'pass.max'      => '密码最多不能超过32个字符!',
        'pass.min'      => '密码最少不能超过6个字符!',
        'reps.confirm'  => '两次输入密码不一致!',
        'pass.require'  => '请填写密码!',
    ];

    protected $scene = [
        'add'   => ['email'=>'require', 'pass'],
        'edit'  => ['email'=>'require', 'pass'],
        'check' => ['email'=>'require', 'pass'=>'require|max:32|min:6'],
    ];

}
