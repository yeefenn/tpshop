<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Role;
use app\admin\model\Based;
use think\facade\Request;

class RoleAll extends controller
{
    public function show(){
        $res = Role::select();
        return view('show',['res'=>$res]);
    }
    public function add(){
        $res = Based::select();
        return view('add',['res'=>$res]);
    }
    public function add_do(){
        $data=Request::param();
//        dump($data);
        $based_id=implode(',',$data['based_id']);
        $dataall=['role_name'=>$data['role_name'],'based_id'=>$based_id];
        $role = new Role();
        $res=$role->save($dataall);
        if($res){
            $this->success('添加成功', 'role_all/show');
        }else{
            $this->error('添加失败');
        }
    }


}
