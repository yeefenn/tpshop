<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
use think\facade\Request;
use think\facade\Session;

class Login extends Controller
{
    public function login(){
        return view('');
    }

    public function login_do_name(){
        config('debug',false);
        $data=Request::param();
        $admin = Admin::where('admin_name', $data['admin_name'])->find();
//        $res=$admin->admin_name;

        if($admin){
            echo json_encode(['status'=>1,'msg'=>'ok']);
        }else{
            echo json_encode(['status'=>0,'msg'=>'no']);
        }
    }
    public function login_do_pwd(){
        config('debug',false);
        $data=Request::param();
        $user = Admin::where('admin_pwd', $data['admin_pwd'])->where('admin_name',$data['admin_name'])->find();
        $res=$user->admin_pwd;
        if($res){
            Session::set('user',$user);
            echo json_encode(['status'=>1,'msg'=>'ok']);
        }else{
            echo json_encode(['status'=>0,'msg'=>'no']);
        }
    }
    public function index(){
        $this->success('欢迎登录后台系统，冲鸭','index/index');
    }
}
