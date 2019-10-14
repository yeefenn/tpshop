<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\based;
use think\facade\Request;

class Baseded extends controller
{
    public function show(){
        $based=new based();
        $res=$based->select();
        return view('show',['res'=>$res]);
    }
    public function add(){
//        $data=Request::param();
//        dump($data);
        return view('add');
    }
    public function add_do(){
        $data=Request::param();
//        dump($data);
        $based=new based();
        $dataall=['based_name'=>$data['based_name'],'based_controller'=>$data['based_controller'],
            'based_action'=>$data['based_action'],'based_url'=>$data['based_url']];
        $res=$based->insert($dataall);
        if($res){
            $this->success('添加成功', 'baseded/show');
        }else{
            $this->error('添加失败');
        }
    }


}
