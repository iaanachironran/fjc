<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\common\controller\Commonbase;

class User extends Commonbase
{
	public function __construct() {
		parent::__construct();
	}

	// 登录页面
	public function index() {
		return $this->fetch();
	}

	// 验证码生成路径
	public function captcha_src() {
		$captcha = new \think\captcha\Captcha();
		return $captcha->entry();
	}

	// 登录验证
	public function check(Request $req) {
		$data = $req->post();
	    $captcha = $data['verify'];

	    if(!captcha_check($captcha)) {
	        // 验证码错误
	        return show(1, '验证码错误');
	    } else {
	        // 验证码正确
	        $where = [
		        		'pass' => md5($data['password']),
		        		'uname' => $data['username']
		        	];
		        	// dump($where);die;
	        $res = Db::table('admin')->where($where)->find();

	        if (!empty($res)) {
		        Session::set('uname', $data['username']);
	        	return show(0, 'ok');
	        }

	        return show(1, '用户名或密码错误');
	    }
	}

	// 退出登录
	public function logout() {
		Session::delete('uname');
        $this->redirect('/admin/');
	}
}
