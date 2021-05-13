<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\common\controller\Commonbase;

class Common extends Commonbase
{
    public $req;
	public $ifLogin;
	function __construct() {
		parent::__construct();
		$this->req = Request::instance();

        // 新闻列表
        $newList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `publish_time` DESC LIMIT 6");
        $this->assign('newList', $newList);

        // 最近发表
        $recList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `publish_time` DESC LIMIT 6");
        $this->assign('recList', $recList);

        // 热门新闻
        $hotList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `clicked` DESC LIMIT 6");
        $this->assign('hotList', $hotList);

        // 判断登录状态
        $this->ifLogin = Session::has('uname') ? 'true' : '';
        if (Session::has('uname')) {
            // dump(Session::get('uname'));die;
            $this->ifLogin = 'true';
        }
        $this->assign('ifLogin', $this->ifLogin);
        $this->assign('uname', Session::get('uname'));
        // dump($this->ifLogin);die;
	}
}
