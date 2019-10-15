<?php
namespace app\admin\controller;
use app\admin\model\Role;
use think\Controller;
use app\admin\model\Admin;
use think\facade\Request;

class Admined extends controller
{
    public function show(){
        $res = Admin::select();

        foreach ($res as $k=>$v){
            $arr=explode(',',$v['role_id']);
            foreach ($arr as $val=>$key){
                $res=Admin::select();
            }
            dump($res);
        }
        dump($res);exit;
        return view('show',['res'=>$res]);
    }
    public function add(){
//        查所有角色
        $res = Role::select();
        return view('add',['res'=>$res]);
    }
    public function add_do(){
//        config('debug',false);
//        $data=Request::param();
//        $user = Admin::where('admin_pwd', $data['admin_pwd'])->find();
//        $res=$user->admin_pwd;
//        if($res){
//            echo json_encode(['status'=>1,'msg'=>'ok']);
//        }else{
//            echo json_encode(['status'=>0,'msg'=>'no']);
//        }

//        config('debug',false);
        $data=Request::param();
        $role_id=implode(',',$data['role_id']);
        $admin = new Admin();
        $res=$admin->save([
            'admin_name'=>$data['admin_name'],'admin_email'=>$data['admin_email'],
            'role_id'=>$role_id
        ]);
        if($res){
            $this->success('添加成功', 'show');
        }else{
            $this->error('添加失败');
        }
//        if($res){
//            echo json_encode(['status'=>1,'msg'=>'ok']);
//        }else{
//            echo json_encode(['status'=>0,'msg'=>'no']);
//        }
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
