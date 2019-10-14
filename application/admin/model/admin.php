<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model{
    public function find_name($data)
    {
        // table方法必须指定完整的数据表名
        $res=Db::name('admin')->where('admin_name',$data)->find();
        return $res;
    }
    public function find_pwd($data)
    {
        $res=Db::name('admin')->where('admin_pwd',$data)->find();
        return $res;
    }
    public function show(){
        $res=Db::name('admin')->select();
        return $res;
    }
    public function insert($data){
        $res=Db::name('admin')->insert($data);
        return $res;
    }


}