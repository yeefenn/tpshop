<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\cate;
use think\facade\Request;

class Index extends controller
{
    public function cate(){
        $cate=new cate();
        $res=$cate->select();
        return view('product_category',['res'=>$res]);
    }
    public function add_cate(){
        $cate=new cate();
        $res=$cate->select();
//        dump($res);
        return view('add_product_category',['res'=>$res]);

    }
    public function add_cate_do(){
        $data=Request::param();
//        dump($data);
        $cate=new cate();
       $data_all=['cate_name'=>$data['cate_name'],'cate_status'=>$data['cate_status'],
           'cate_price'=>$data['cate_price'],'cate_by_status'=>$data['cate_by_status'],
           'cate_des'=>$data['cate_des'],'cate_order'=>$data['cate_order'],'cate_pid'=>$data['cate_pid']];
     $res=$cate->insert($data_all);
     if($res){
         $this->success('添加成功', 'Index/cate');
     }else{
         $this->error('添加失败');
     }

    }

}
