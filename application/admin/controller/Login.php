<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\admin;
use think\facade\Request;

class Login extends controller
{
    public function login(){
        return view('');
    }
    public function login_do_name(){
        config('debug',false);
        $data=Request::param();
        $admin=new Admin();
        $res=$admin->find_name($data['admin_name']);
       if($res){
           echo json_encode(['status'=>1,'msg'=>'ok']);
       }else{
           echo json_encode(['status'=>0,'msg'=>'no']);
       }
    }
    public function login_do_pwd(){
        config('debug',false);
        $data=Request::param();
        $admin=new Admin();
        $res=$admin->find_pwd($data['admin_pwd']);
        if($res){
            echo json_encode(['status'=>1,'msg'=>'ok']);
        }else{
            echo json_encode(['status'=>0,'msg'=>'no']);
        }
    }
    public function index(){
        return view('index/welcome');
    }
}
