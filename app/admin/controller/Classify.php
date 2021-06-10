<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Classify extends Base
{
	public $req;
	public function __construct() {
		parent::__construct();
		$this->req = Request::instance();
	}

	// 
	public function classifyList() {
		if ($this->req->isPost()) {

			$list = $this->getList();

			$reData = array();
            $reData['code']  = 0;
            $reData['msg']   = '';
            $reData['count'] = count($list);	// 所有 图书数量
            $reData['data']  = $list;

        	echo json_encode($reData);die;
		} else {
			return $this->fetch();
		}
	}

	// 
	public function getList() {
		$list = Db::query("SELECT * FROM classify ORDER BY id DESC");
		return $list;
	}

	// 添加分类
	public function addclassify() {
		if ($this->request->isPost()) {

			// 接收数据
			$name = input('post.name');

			// 查看是否有相同名称
			$res = Db::table('classify')->where("name='".$name."'")->find();
			// dump($res);die;

			if ($res) {
				return show(0, '名称已经存在');
			}

			// 保存数据
			$res = Db::execute('INSERT INTO classify (name) VALUES (:name)',
				[
					'name'	=> $name,
				]);

			// 返回结果
			if ($res) {
				return show(1, '添加成功');
			} else {
				return show(0, '添加失败');
			}

		} else {
			return $this->fetch();
		}
	}
}