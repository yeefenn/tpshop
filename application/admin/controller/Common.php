<?php
namespace app\admin\controller;
use app\admin\service\Admi;
use think\Controller;
use think\facade\Session;
use think\facade\View;
class Common extends Controller{
//   判断session
    public function __construct(){
        parent::__construct();
       $admin=Session::get('user');
       if(!$admin){
           $this->success("请先登录","Login/login");
       }

        //检查权限，有权限继续执行，
        if(!$this->checkBased()){
            if(request()->isAjax()){
                return ["status"=>-1,"msg"=>"没有权限操作"];
            }else{
                $this->success("你没有权限操作",'Index/index');
            }
        }
        $admin=new Admi();
        $meum=$admin->getMeum();
        $meum=$admin->getMeumTree($meum);
        dump($meum);
        View::share("meum",$meum);


//        View::share('admin',$admin);
//       dump($admin);exit;
    }

    //false 没有权限，true 有权限
    public function checkBased(){
        $currentAdmin=Session::get("admin");
        //检测当前登录用户是否是超级管理员
        if(in_array($currentAdmin["admin_name"],config("web.super_admin"))){
            return true;
        }
        //如果不是超级管理员，检测
        //获取要访问的控制器和方法
        $access=ucfirst(strtolower(request()->controller()))."/".strtolower(request()->action());
        if(in_array($access,config("web.no_check_action"))){
            return true;
        }
        //获取当前登录用户拥有的权限
        $mybased=new Admin();
        $mybased=$mybased->getNodeByAdminId(Session::get("admin")["admin_id"]);
        if(in_array($access,$mybased)){
            return true;
        }else{
            return false;
        }
    }




}





?>