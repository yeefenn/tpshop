<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\role;
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
        $data=Request::param();
        dump($data);

    }


}
