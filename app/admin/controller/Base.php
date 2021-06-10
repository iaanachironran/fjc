<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\common\controller\Commonbase;

class Base extends Commonbase
{
	public $if_login;
	public function __construct() {
		parent::__construct();

		// 判断登录状态
        if (Session::has('uname')) {
            $this->if_login = 'true';
            $this->assign('uname', Session::get('uname'));
        } else {
            $this->if_login = '';
            $this->redirect('/admin/user/');
        }
        $this->assign('if_login', $this->if_login);
	}

}
