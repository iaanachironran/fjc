<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Books extends Base
{
	public $req;
	public function __construct() {
		parent::__construct();
		$this->req = Request::instance();
	}

	// 手动 开启/关闭 图书推荐
	public function recommend() {
		$data = $this->req->post();
		if ($data['recommend'] == 'off') {
			$res  = Db::table('books')->where('id', $data['id'])->update( [ 'recommend' => 'on' ] );
			if ($res) {
				return show(0, 'on');
			}
			return show(1, '数据更新失败');

		} else if ($data['recommend'] == 'on') {
			$res  = Db::table('books')->where('id', $data['id'])->update( [ 'recommend' => 'off' ] );
			if ($res) {
				return show(0, 'off');
			}
			return show(1, '数据更新失败');
		}
	}
	// 图书列表
	public function booksList() {
		if ($this->req->isPost()) {
			$data = $this->req->post();
			$list = Db::query("SELECT id,recommend,title,FROM_UNIXTIME(publish_time,'%Y-%m-%d %H:%i:%S') AS publish_time,FROM_UNIXTIME(create_time,'%Y-%m-%d %H:%i:%S') AS create_time,status,clicked,praise FROM books ORDER BY create_time DESC");

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

	// 添加图书
	public function addbooks() {
		if ($this->request->isPost()) {

			// 接收数据
			$data = $this->request->param();
			$data['create_time'] = time();

			$data['img'] 	 	 = $data['file'];
			unset($data['file']);

			$res = Db::execute('
				INSERT INTO books (create_time, title, content, img, classify_id)
				VALUES (:create_time, :title, :content, :img, :classify_id)',
				[
					'create_time'	=> $data['create_time'],
					'title'			=> $data['title'],
					'content'		=> $data['content'],
					'img'			=> $data['img'],
					'classify_id'	=> $data['classify_id'],
				]);

			// 返回结果
			if ($res) {
				return show(1, '添加成功');
			} else {
				return show(0, '添加失败');
			}

		} else {
			// 获取分类列表
			$classifylist = action('classify/getList');
			$this->assign('classifylist', $classifylist);

			return $this->fetch();
		}
	}

	// 关闭图书
	public function editStatus() {
		$data = $this->req->post();

		if ($data['method'] == 'show') {
			// 更新图书数据和状态
			$res  = Db::table('books')->where('id', $data['id'])->update(
				[
					'status' 	   => $data['status'],
					'publish_time' => time(),
				]
			);
		} else if ($data['method'] == 'close') {
			// 更新图书数据和状态
			$res  = Db::table('books')->where('id', $data['id'])->update(
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

	// 编辑图书
	public function editbooks() {
		if ($this->request->isPost()) {
			// 接收数据
			$data = $this->request->param();
			$data['create_time'] = time();
			$data['status'] 	 = '0';
			$data['img'] 	 	 = $data['file'];
			$data['classify_id'] = $data['classify_id'];
			unset($data['file']);
			// dump($data);die;

			$res = Db::table('books')->where('id', $data['id'])->update($data);
			return show(0, '修改成功');

		} else {
			$id = input('get.id');

			// 图书 详情
			$info = Db::table('books')->where('id', $id)->find();
			$this->assign('info', $info);

			// 获取分类列表
			$classifylist = action('classify/getList');
			$this->assign('classifylist', $classifylist);

			return $this->fetch();
		}
	}

	// 图片上传
    public function upimg() {
        if($_FILES['file']['error']===0) {

            // 获取文件扩展名
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            //保存附件图片的根目录
            $cfg = array(
                // 'rootPath' => ROOT_PATH.'public'.'/'.'upload'.'/'.'books_img'.'/',
                'rootPath' => 'upload/books_img/',
                'exts'     => array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                'autoSub'  => false,    // 自动使用子目录保存上传文件 默认为true
            );

            $filename = $cfg['rootPath'].time().Session::get('uid').'.'.$ext;    // 最终保存的 路径+文件名

            if (file_exists($cfg['rootPath'].time().$_FILES["file"]["name"])) {
                // 文件已经存在

            } else {
                if (!file_exists($cfg['rootPath'])) {
                    mkdir($cfg['rootPath'], 0755, true);
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
            }

            $data['img'] = '/'.$filename; // 最终的文件路径

            // 返回上传结果
            $reData['code']  = 0;
            $reData['msg']   = '';
            $reData['data']['src']  = $data['img'];
            echo json_encode($reData);
        }
    }
}
