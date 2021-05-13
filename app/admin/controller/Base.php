<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\common\controller\Commonbase;

class Base extends Commonbase
{
	public $ifLogin;
	public function __construct() {
		parent::__construct();

		// 判断登录状态
        if (Session::has('uname')) {
            $this->ifLogin = 'true';
            $this->assign('uname', Session::get('uname'));
        } else {
            $this->ifLogin = '';
            $this->redirect('/admin/user/');
        }
        $this->assign('ifLogin', $this->ifLogin);
	}

}
