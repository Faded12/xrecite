<?php
namespace app\index\controller;

use think\Controller;

//需要继承Base
class Index extends Base
{
    public function index()
    {
        session("userId", null);
        $this->assign('title', '首页');
        return $this->fetch();
    }
}
