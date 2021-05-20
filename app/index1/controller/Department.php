<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;

class Department extends Common
{
	public $req;
	function __construct() {
		parent::__construct();
		$this->req = Request::instance();

        $con = __CLASS__;
        $arr = explode('\\', $con);
        $this->assign('_class', strtolower($arr[3]));
	}

    public function index() {
        return $this->fetch();
    }
    public function resource() {
        return $this->fetch();
    }
}
