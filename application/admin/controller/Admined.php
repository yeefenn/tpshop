<?php
namespace app\admin\controller;
use app\admin\model\role;
use think\Controller;
use app\admin\model\admin;
use think\facade\Request;

class Admined extends controller
{
    public function show(){
        $admin=new admin();
        $res=$admin->select();
//        dump($res);
//        exit;
        return view('show',['res'=>$res]);
    }
    public function add(){
        $role=new role();
        $res=$role->select();
//        $data=Request::param();
//        dump($data);
//        查所有角色
        return view('add',['res'=>$res]);
    }
    public function add_do(){
        $data=Request::param();
//        dump($data);
        $admin=new admin();
        $role_id=implode(',',$data['role_id']);
//        dump($role_id);
        $dataall=['admin_name'=>$data['admin_name'],'admin_email'=>$data['admin_email'],
            'role_id'=>$role_id];
        $res=$admin->insert($dataall);
        if($res){
            $this->success('添加成功', 'admined/show');
        }else{
            $this->error('添加失败');
        }
    }

}
