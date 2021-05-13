<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use think\Cookie;
use think\Config;
use app\common\controller\Commonbase;

class User extends Commonbase
{
	public $req;
    public $ifLogin;
    public $u_id;
    private $table_user;
	function __construct() {
		parent::__construct();
		$this->req = Request::instance();

        // 判断当前控制器, 使相应导航高亮
        $con = __CLASS__;
        $arr = explode('\\', $con);
        $this->assign('_class', strtolower($arr[3]));

        $this->table_user = Config::get('table_name.user');

	}

    // 退出
    public function logout() {
        Session::delete('uname');
        $this->redirect('/');
    }

    // 登录
    public function login() {
        // 判断是否是post提交方式
        if ($this->req->isPost()) {
            // 接收全部数据
            $data = $this->req->post();
            // 验证数据
            $result = $this->validate($data,'User.check');  // 验证的check场景模式
            if(true !== $result){
                // 验证失败 返回错误信息
                return show(1, $result);
            }

            // 查找对应email的用户信息
            $userInfo = Db::query("SELECT * FROM user WHERE email='".$data['email']."' LIMIT 1");

            // 验证对应email的用户是否存在, 密码是否正确
            $encrypt_method = Config::get('encrypt_method');
            if ($encrypt_method == 'md5') {
                if (empty($userInfo) || md5($data['pass'])!=$userInfo[0]['pass']) {
                    return show(1, '账号或密码错误!');
                }
            } else if ($encrypt_method == 'password_hash') {
                if (empty($userInfo) || !password_verify($data['pass'], $userInfo[0]['pass'])) {
                    return show(1, '账号或密码错误!');
                }
            }

            // 设置SESSION . COOKIE
            Session::set('uname',  $userInfo[0]['uname']); // 用户名
            Session::set('userId', $userInfo[0]['id']); // 用户id
            // 保存登录信息
            return show(0, '登录成功!');

        } else {
            return $this->fetch();
        }
    }

    // 注册
    public function reg() {
        // 判断是否是post提交方式
        if ($this->req->isPost()) {

            // 接收全部数据
            $data = $this->req->post();

            // 判断是否同意相关协议
            if (!isset($data['agree']) || $data['agree']!='on') {
                return show(1, '请阅读相关协议!');
            }

            // 验证数据
            $result = $this->validate($data,'User');
            if(true !== $result){
                // 验证失败 返回错误信息
                return show(1, $result);
            }

            // 获取加密方式 + 对用户提交密码进行加密
            $encrypt_method = Config::get('encrypt_method');
            if ($encrypt_method == 'md5') {
                $pass = md5($data['pass']);
            } else if ($encrypt_method == 'password_hash') {
                $pass = password_hash($data['pass'], PASSWORD_DEFAULT);
            }

            // 查看email是否存在
            $ifExist = Db::query("SELECT * FROM user WHERE email='".$data['email']."' LIMIT 1");
            if (!empty($ifExist)) {
                return show(1, '学号已存在!');
            }

            // 查看uname是否存在
            $ifExist = Db::query("SELECT * FROM user WHERE uname='".$data['uname']."' LIMIT 1");
            if (!empty($ifExist)) {
                return show(1, '用户名已存在!');
            }

            // 保存注册信息
            try{
                $res = Db::execute('INSERT INTO user (uname, email, pass) VALUES (:uname, :email, :pass)', ['uname'=>$data['uname'],'email'=>$data['email'],'pass'=>$pass]);
            }catch(\Execption $e){
                return show(1, $e->getMessage());
            }

            return show(0, '注册成功, 请登录!');

        } else {
            return $this->fetch();
        }
    }

    // 个人中心
    public function center() {
        // 登录状态
        $this->ifLogin = Session::has('uname') ? 'true' : '';
        if (Session::has('uname')) {
            $this->ifLogin = 'true';
        } else {
            $this->redirect('/index/user/login');
        }
        $this->assign('ifLogin', $this->ifLogin);

        // userid
        $this->u_id = Session::get('userId');
        $this->assign('u_id', $this->u_id);

        // post提交数据
        if ($this->req->isPost()) {
            $data = $this->req->post();

            $sql = "UPDATE ".$this->table_user." SET sex='".$data['sex']."',uname='".$data['uname']."',avatar_img='".$data['file']."' WHERE id=".$this->u_id." LIMIT 1";
            $res = Db::table($this->table_user)->execute($sql);
            if ($res) {
                return show(0, '保存成功!');
            }
            return show(1, '保存失败, 请重试!');
            
        } else {
            // 用户信息
            $userinfo = Db::table($this->table_user)->field('id,uname,email,sex,avatar_img')->where("id=".$this->u_id)->find();
            $this->assign('userinfo', $userinfo);
            // 用户名
            $this->assign('uname', $userinfo['uname']);

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
                // 'rootPath' => ROOT_PATH.'public'.'/'.'upload'.'/'.'avatar_img'.'/',
                'rootPath' => 'upload/avatar_img/',
                'exts'     => array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                'autoSub'  => false,    // 自动使用子目录保存上传文件 默认为true
            );

            $filename = $cfg['rootPath'].time().Session::get('userId').'.'.$ext;    // 最终保存的 路径+文件名

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

    public function test(){
        echo ROOT_PATH.'public'.DS.'upload'.DS.'avatar_img'.DS;
    }
}
