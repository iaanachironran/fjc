<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class Message extends Base
{
	public $req;
	public function __construct() {
		parent::__construct();
		$this->req = Request::instance();
	}

	// 留言列表
	public function meslist() {
		if ($this->req->isPost()) {
			$data = $this->req->post();
			$list = Db::query("SELECT id,user,method,content FROM message WHERE status='0'");

			$reData = array();
            $reData['code']  = 0;
            $reData['msg']   = '';
            $reData['count'] = count($list);	// 所有 留言数量
            $reData['data']  = $list;

        	echo json_encode($reData);die;
		} else {
			return $this->fetch();
		}
	}

	// 添加留言
	public function main() {
		return $this->fetch();
	}

	// 关闭留言
	public function editStatus() {
		$data = $this->req->post();

		$res  = Db::table('message')->where('id', $data['id'])->update(['status' => $data['status']]);

		if ($res == 1) {
			if ($data['method'] == 'show') {
				return show(0, '发布成功');
			} else if ($data['method'] == 'close') {
				return show(0, '删除成功');
			}

		} else {
			return show(1, '状态更新失败');
		}
	}
}
