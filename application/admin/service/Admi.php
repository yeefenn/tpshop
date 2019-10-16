<?php
namespace app\admin\service;
use app\admin\model\Admin;
use app\admin\model\Admin_role;
use app\admin\model\Based;
use app\admin\model\Role;
use think\facade\Session;
class Admi{
    public function getNodeByAdminId($admin_id){
        $adminRole=new Admin_role();
        $role_id=$adminRole->where("admin_id",$admin_id)->column("role_id");
        $role=new Role();
        $role=$role->all($role_id);
        $mybased=[];
        foreach($role as $key=>$val){
            $mybased=array_merge($mybased,$val->based->toArray());
        }
        $myaccess=[];
        foreach($mybased as $key=>$val){
            array_push($myaccess,ucfirst(strtolower($val["based_controller"]))."/".strtolower($val["based_action"]));
        }
        $myaccess=array_unique($myaccess);
        return $myaccess;
    }
    //取左侧菜单
    public function getMeum(){
        $admin_name=Session::get("user")["admin_name"];
        if(in_array($admin_name,config("web.super_admin"))){
            //取所有的权限
            $meum=(new Based())->where("based_ismeum",1)->all()->toArray();
        }else{
            $admin_id=Session::get("admin")["admin_id"];
            $admin=new Admin();
            $admin=$admin->get($admin_id);
            $menu=[];
            foreach($admin->role as $key=>$val){
                $menu=array_merge($menu,$val->based->where("based_ismeum",1)->toArray());
            }
            //去重未实现

        }
        return $meum;
    }
    public function getMeumTree($meum,$pid=0){
        $meumTree=[];
        foreach($meum as $key=>$val){
            if($val["based_pid"]==$pid){
                if($son=$this->getMeumTree($meum,$val['based_id'])){
                    $val["son"][]=$son;
                }
                $meumTree[]=$val;
            }
        }
        return $meumTree;
    }

}