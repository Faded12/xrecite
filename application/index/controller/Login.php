<?php
namespace app\index\controller;

use think\Controller;

class Login extends Controller
{

    /**
     * 获取post数据
     * @return mixed
     */
//    public function getPostData()
//    {
//        header('Access-Control-Allow-Origin: *');
////        header('Access-Control-Allow-Headers: X-Requested-With');
//        $postData=file_get_contents('php://input', true);
//        $postArr = json_decode($postData, true);
//        return $postArr;
//
//    }

    protected function setTitle($title)
    {
        $this->assign("title",$title);
    }


    public function login(){
        session("userId", 123);
        $this->assign('title', '背个X啊 - 登陆');
        return $this->fetch();
    }

    public function register()
    {
        if(request()->isPost()){
            $data = input('post.');

            if(!captcha_check($data['verifycode'])) {
                // 校验失败
                $this->error('验证码不正确');
            }
            //严格校验 tp5 validate

            if($data['password'] != $data['repassword']) {
                $this->error('两次输入的密码不一样');
            }
            // 自动生成 密码的加盐字符串
            $data['code'] = mt_rand(100, 10000);
            $data['password'] = md5($data['password'].$data['code']);
            //$data = 12;// test
            try {
                $res = model('User')->add($data);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if($res) {
                $this->success('注册成功',url('user/login'));
            }else{
                $this->error('注册失败');
            }

        }else {
            $this->setTitle("注册");
            return $this->fetch();
        }
        //QLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'singwa' for key 'username'

    }
//    登陆验证
//    public function loginVerification(){
//        $postArr=$this->getPostData();
//        $userName=$postArr["userName"];
//        $password=md5($postArr["password"]);
//        $userInfo=M()->table("js_user_info a")->join("left join js_user_role b on a.user_code=b.User_Code")->
//        field("a.user_uid,a.user_code,a.user_name,a.user_nickname,a.user_status,b.Role_Code")->
//        where("a.user_code='%s' and a.user_password='%s'",$userName,$password)->
//        find();
//
//        if($userInfo==null)
//        {
//            $this->ajaxReturn(array("status" => "fail", "msg" => "用户名或密码错误"));
//        }
//        else
//        {
//            session("roleCode",$userInfo["role_code"]);
//            if($userInfo["role_code"]==2)
//            {
//                $agentInfo=M("agent")->field("uid")->where("user_uid='%s' and status=0",$userInfo["user_uid"])->find();
//                if($agentInfo==null)
//                {
//                    $this->ajaxReturn(array("status" => "fail", "msg" => "您的经销商账号已被注销"));
//
//                }
//                session('agentId',$agentInfo["uid"]);
//            }
//            session('userId',$userInfo["user_uid"]);
//            $this->ajaxReturn(array("status" => "ok", "data" => $userInfo));
//
//        }
//
//    }

}