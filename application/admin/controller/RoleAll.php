<?php
namespace app\admin\controller;
use app\admin\service\Base;
use think\Controller;
use app\admin\model\Role;
use app\admin\model\Based;
use think\facade\Request;

class RoleAll extends Common
{
    public function show(){
        $res = Role::select();
        return view('show',['res'=>$res]);
    }
    public function add(){
//        $res = Based::select();
        $based = Based::select();
        $base=new Base();
        $res=$base->orderCate($based);
        return view('add',['res'=>$res]);
    }
    public function add_do(){
        $data=Request::param();
//        dump($data);
        $dataall=['role_name'=>$data['role_name']];
        $role = new Role();
        $res=$role->save($dataall);
        $role->baseds()->saveAll($data['based_id']);
        if($res){
            $this->success('添加成功', 'role_all/show');
        }else{
            $this->error('添加失败');
        }
    }


}
