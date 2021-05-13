<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use think\Cookie;

class Art extends Common
{
	public $req;
	function __construct() {
		parent::__construct();
		$this->req = Request::instance();

        // 获取当前控制器名称, 使相应导航高亮
		$con = __CLASS__;
        $arr = explode('\\', $con);
        $this->assign('_class', strtolower($arr[3]));
	}

	// 文章详情页
    public function artDet() {
    	// input助手函数接收文章id
    	$id = input('get.id');

    	// 如果没有传递id , 直接跳转首页
    	if (empty($id) || !isset($id)) {
    		$this->redirect('');
    	}

		// 格式化$id, 拼接sql语句
    	$sql = sprintf("SELECT * FROM news WHERE id=%u", $id);
    	$det = Db::query($sql);

    	// 判断是否存在相关新闻
    	if (empty($det)) {
    		$this->error('你要找的新闻失踪了...', '/');
    	} else {
            // 更新浏览量
            Db::execute("UPDATE news SET clicked=clicked+1 where id=".$id);
    		$this->assign('det', $det[0]);
    	}

        // 评论列表
        $commentList = Db::query("
            SELECT 
            c.id, c.a_id, c.u_id, c.uname, c.content, FROM_UNIXTIME(c.c_time, '%m-%d %H:%i') AS c_time, 
            u.avatar_img 
            FROM comment c 
            LEFT JOIN user u 
            ON c.u_id=u.id 
            WHERE a_id=".$id
        );

        if (!empty($commentList)) {
            $this->assign('commentList', $commentList);
        } else {
            $this->assign('commentList', '');
        }

        $u_id = Session::get('userId');
        $this->assign('u_id', $u_id);

    	// dump($det);die;
    	return $this->fetch();
    }

    // 文章列表
    public function artList() {
    	// 判断是否是
    	if ($this->req->isPost()) {
    		$data = $this->req->post();
    		dump($data);die;

    		$reData = array();
            $reData['code']  = 0;
            $reData['msg']   = '';
            // $reData['count'] = $this->pubArtCou;	// 已发布文章数量
            $reData['count'] = $this->allArtCou;	// 所有 文章数量
            $reData['data']  = $articleList;

        	echo json_encode($reData);die;

    	} else {
	        return $this->fetch();
    	}
    }

    // 最近发表
    public function artRecent() {
		// $data = $this->req->param();
		// dump($data);die;
    	$recList = Db::query("SELECT * FROM `news` WHERE `status`='1' ORDER BY `publish_time` LIMIT 6");

    	// 组装返回数据
    	$reData = array();
        $reData['code']  = 0;
        $reData['msg']   = '';
        $reData['count'] = count($recList);
        $reData['data']  = $recList;

    	echo json_encode($reData);die;
    }

    // 接收评论内容
    public function artComment() {
        // 判断是否登录
        if (!Session::has('uname') || !Session::has('userId')) {
            return show(1, '未登录!');
        }

        // 接收数据
        $data = $this->req->post();
        if (mb_strlen($data['content']) > 500) {
            return show(1, '评论长度超过500字!');
        }

        // 组装 保存和返回的数据
        $data['u_id'] = Session::get('userId'); // 评论人 id
        $data['uname'] = Session::get('uname'); // 评论人 用户名

        // 保存注册信息
        $saveData = [
                    'a_id'      =>$data['a_id'],
                    'u_id'      =>$data['u_id'],
                    'uname'     =>$data['uname'],
                    'content'   =>$data['content'],
                    'c_time'    =>time(),
        ];
        try{
            Db::table('comment')->insert($saveData);
            $c_id = Db::table('comment')->getLastInsID();// 评论成功后生成的评论id
        }catch(\Execption $e){
            return show(1, $e->getMessage());
        }

        // 查询用户信息, 头像地址
        $userinfo = Db::table('user')->where('id='.$data['u_id'])->find();
        if (!empty($userinfo['avatar_img'])) {
            $saveData['avatar_img'] = $userinfo['avatar_img'];
        } else {
            $saveData['avatar_img'] = "/static/index/images/ic_launcher_nougat.png";
        }

        $saveData['c_time'] = date("m-d H:i",$saveData['c_time']);  //时间
        $saveData['c_id'] = $c_id;  // 评论成功后生成的评论id
        
        return show(0, '评论成功', $saveData);
    }

    // 删除评论
    public function delComment() {
        // 接收数据
        $id = input('post.id');
        $res = Db::table('comment')->execute("DELETE FROM comment WHERE id=?",[$id]);
        if ($res == 1) {
            return show(0, '删除成功!');
        }
        return show(1, '删除失败!');
    }
}
