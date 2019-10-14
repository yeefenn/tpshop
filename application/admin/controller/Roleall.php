<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\role;
use app\admin\model\based;
use think\facade\Request;

class RoleAll extends controller
{
    public function show(){
        $role=new role();
        $res=$role->select();
//        dump($res);
        return view('show',['res'=>$res]);
    }
    public function add(){
        $based=new based();
        $res=$based->select();
//        dump($res);exit;
        return view('add',['res'=>$res]);
    }
    public function add_do(){
        $data=Request::param();
        $based_id=implode(',',$data['based_id']);
//        dump($data);
        $based=new role();
        $dataall=['role_name'=>$data['role_name'],'based_id'=>$based_id];
        $res=$based->insert($dataall);
        if($res){
            $this->success('添加成功', 'roleall/show');
        }else{
            $this->error('添加失败');
        }
    }


}
