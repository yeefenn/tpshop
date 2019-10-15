<?php
namespace app\admin\controller;
use app\admin\service\Cat;
use think\Controller;
use app\admin\model\Cate;
use think\facade\Request;

class Index extends controller
{
    public function cate(){
        $cate = Cate::select();
        $cat=new Cat();
        $res=$cat->orderCate($cate);
//        dump($res);exit;
        return view('product_category',['res'=>$res]);
    }
    public function add_cate(){
        $cate = Cate::select();
        $cat=new Cat();
        $res=$cat->orderCate($cate);
        return view('add_product_category',['res'=>$res]);
    }
    public function add_cate_do(){
        $data=Request::param();
        $data_all=['cate_name'=>$data['cate_name'],'cate_status'=>$data['cate_status'],
            'cate_price'=>$data['cate_price'],'cate_by_status'=>$data['cate_by_status'],
            'cate_des'=>$data['cate_des'],'cate_order'=>$data['cate_order'],'cate_pid'=>$data['cate_pid']];
        $cate = new Cate();
        $res=$cate->save($data_all);
         if($res){
             $this->success('添加成功', 'Index/cate');
         }else{
             $this->error('添加失败');
         }
    }

}
