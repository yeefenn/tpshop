<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Based;
use think\facade\Request;
use app\admin\service\Base;

class Baseded extends controller
{
    public function show(){
        $based = Based::select();
        $base=new Base();
        $res=$base->orderCate($based);
//        dump($res);exit;
        return view('show',['res'=>$res]);
    }
    public function add(){
        $based = Based::select();
        $base=new Base();
        $res=$base->orderCate($based);
//        dump($res);exit;
        return view('add',['res'=>$res]);
    }
    public function add_do(){
        $data=Request::param();
        $based = new Based();
        $based_url=$data['based_action'].'/'.$data['based_controller'];
        $dataall=['based_name'=>$data['based_name'],'based_controller'=>$data['based_controller'],
            'based_action'=>$data['based_action'],'based_url'=>$based_url,'based_pid'=>$data['based_pid']];
        $res=$based->save($dataall);
        if($res){
            $this->success('添加成功', 'baseded/show');
        }else{
            $this->error('添加失败');
        }
    }


}
