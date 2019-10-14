<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class based extends Model{
    public function select(){
        $res=Db::name('based')->select();
        return $res;
    }
    public function insert($data){
        $res=Db::name('based')->insert($data);
        return $res;
    }


}