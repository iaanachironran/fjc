<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class News extends Base
{
	public $req;
	public function __construct() {
		parent::__construct();
		$this->req = Request::instance();
	}

	// 文章列表
	public function newsList() {
		if ($this->req->isPost()) {
			$data = $this->req->post();
			$list = Db::query("SELECT id,title,FROM_UNIXTIME(publish_time,'%Y-%m-%d %H:%i:%S') AS publish_time,FROM_UNIXTIME(create_time,'%Y-%m-%d %H:%i:%S') AS create_time,status,clicked,praise FROM news ORDER BY create_time DESC");

			$reData = array();
            $reData['code']  = 0;
            $reData['msg']   = '';
            $reData['count'] = count($list);	// 所有 文章数量
            $reData['data']  = $list;

        	echo json_encode($reData);die;
		} else {
			return $this->fetch();
		}
	}

	// 添加文章
	public function addnews() {
		if ($this->request->isPost()) {

			// 接收数据
			$data = $this->request->param();
			$data['create_time'] = time();

			// 保存数据
			$res = Db::execute('
				INSERT INTO news (create_time, title, content)
				VALUES (:create_time, :title, :content)',
				[
					'create_time'	=> $data['create_time'],
					'title'			=> $data['title'],
					'content'		=> $data['content'],
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

	// 关闭文章
	public function editStatus() {
		$data = $this->req->post();

		if ($data['method'] == 'show') {
			// 更新新闻数据和状态
			$res  = Db::table('news')->where('id', $data['id'])->update(
				[
					'status' 	   => $data['status'],
					'publish_time' => time(),
				]
			);
		} else if ($data['method'] == 'close') {
			// 更新新闻数据和状态
			$res  = Db::table('news')->where('id', $data['id'])->update(
				[
					'status' 	   => $data['status'],
				]
			);
		}

		if ($res == 1) {
			if ($data['method'] == 'show') {
				return show(0, '发布成功');
			} else if ($data['method'] == 'close') {
				return show(0, '关闭成功');
			}

		} else {
			return show(1, '产品状态更新失败');
		}
	}

	// 编辑文章
	public function editnews() {
		if ($this->request->isPost()) {
			// 接收数据
			$data = $this->request->param();
			$data['create_time'] = time();
			$data['status'] 	 = '0';
			// $data['id'] 	 	 = $data['c_id'];

			$res = Db::table('news')->where('id', $data['id'])->update($data);
			return show(0, '修改成功');

		} else {
			$id = input('get.id');

			// 文章 详情
			$info = Db::table('news')->where('id', $id)->find();
			$this->assign('info', $info);

			return $this->fetch();
		}
	}
}
