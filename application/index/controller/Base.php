<?php
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
    public function __construct() {

        parent:: __construct();
//        Log::write(session('?abc'));
        if(session('?userId'))
        {
//            $this->redirect(url('login/login'));
        }
        else
        {
//             Log::write("222222222222222222");
            $this->redirect(url('login/login'));

//            $this->redirect('/index.php/index/index/index.html');
        }
    }
}
