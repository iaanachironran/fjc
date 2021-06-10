<?php
namespace app\common\controller;
use think\Controller;

class Commonbase extends Controller
{
	public $web_title;
	function __construct() {
		parent::__construct();

        // 网站名称设置
        $this->web_title = '小小图书';
        $this->assign('web_title', $this->web_title);
    }
}
