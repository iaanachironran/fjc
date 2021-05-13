<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;

class Index extends Common
{
	public $req;
	function __construct() {
		parent::__construct();
		$this->req = Request::instance();

        // 判断当前控制器, 使相应导航高亮
		$con = __CLASS__;
        $arr = explode('\\', $con);
        $this->assign('_class', strtolower($arr[3]));
	}

    // 主页
    public function index() {
    	// 新闻列表
    	$newList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `publish_time` DESC LIMIT 10");
    	$this->assign('newList', $newList);

    	// 最近发表
    	$recList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `publish_time` DESC LIMIT 6");
    	$this->assign('recList', $recList);

    	// 热门新闻
    	$hotList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `clicked` DESC LIMIT 6");
    	$this->assign('hotList', $hotList);

        return $this->fetch();
    }

    // 流加载
    public function xxl() {
        $data = $this->req->get();
        $page = $data['page'];
        $size = 5;
        // 新闻列表
        $newList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `publish_time` DESC LIMIT ".($page-1)*$size.",".($page*$size));
        $all = Db::query("SELECT COUNT(*) AS count FROM `news` WHERE `status`='1'");
        foreach ($newList as $key => $v) {
            $newList[$key]['title'] = mb_substr($v['title'], 0, 50, "utf-8")."...";
            $newList[$key]['publish_time'] = date("Y-m-d", $v['publish_time']);
        }

        $reData = array();
        $reData['code']  = 0;
        $reData['msg']   = '';
        $reData['count'] = count($newList);    // 所有 文章数量
        $reData['data']  = $newList;
        $reData['pages'] = ceil($all[0]['count']/$size)-1;

        echo json_encode($reData);die;
    }
}
