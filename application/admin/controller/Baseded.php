<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\based;
use think\facade\Request;

class Baseded extends controller
{
    public function show(){
        $based=new based();
        $res=$based->orderCate($based->select());
//        dump($res);
//        exit;
        return view('show',['res'=>$res]);
    }
    public function add(){
        $based=new based();
        $res=$based->orderCate($based->select());
        return view('add',['res'=>$res]);
    }
    public function add_do(){
        $data=Request::param();
//        dump($data);
//        exit;
        $based=new based();
        $based_url=$data['based_action'].'/'.$data['based_controller'];
        $dataall=['based_name'=>$data['based_name'],'based_controller'=>$data['based_controller'],
            'based_action'=>$data['based_action'],'based_url'=>$based_url,'based_pid'=>$data['based_pid']];
        $res=$based->insert($dataall);
        if($res){
            $this->success('添加成功', 'baseded/show');
        }else{
            $this->error('添加失败');
        }
    }


}
