<?php
namespace app\admin\controller;
use app\admin\model\Role;
use think\Controller;
use app\admin\model\Admin;
use think\facade\Request;

class Admined extends Common
{
    public function show(){
//        $res=Admin::get(1);
        $res = Admin::select();
        return view('',['res'=>$res]);
    }
    public function add(){
//        查所有角色
        $res = Role::select();
        return view('add',['res'=>$res]);
    }
    public function add_do(){
        $data=Request::param();
        $admin = new Admin();
        $res=$admin->save([
            'admin_name'=>$data['admin_name'],'admin_email'=>$data['admin_email'],'admin_pwd'=>$data['admin_pwd']
        ]);
        $admin->roles()->saveAll($data['role_id']);
        if($res){
            $this->success('添加成功', 'show');
        }else{
            $this->error('添加失败');
        }
    }
    public function find(){
        config('debug',false);
        $data=Request::param();
        $res = Admin::where('admin_name', $data['admin_name'])->find();
//        dump($res);exit;
        if($res){
            echo json_encode(['status'=>0,'msg'=>'no']);
        }else{
            echo json_encode(['status'=>1,'msg'=>'yes']);
        }
    }


}
