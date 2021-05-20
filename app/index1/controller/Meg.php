<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;

class Meg extends Common
{
	public $req;
	function __construct() {
		parent::__construct();
		$this->req = Request::instance();

        $con = __CLASS__;
        $arr = explode('\\', $con);
        $this->assign('_class', strtolower($arr[3]));
	}

    public function index()
    {
    	if ($this->req->isPost()) {
            $data = $this->req->post();

            // 保存信息
            try{
                $res = Db::execute('INSERT INTO message (user, method, content) VALUES (:user, :method, :content)', ['user'=>$data['user'],'method'=>$data['method'], 'content'=>$data['content']]);
            }catch(\Execption $e){
                return show(1, $e->getMessage());
            }

            return show(0, '提交成功, 谢谢!');
        }

        return $this->fetch();
    }
}
