<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class role extends Model{
    public function select()
    {
        // table方法必须指定完整的数据表名
        $res=Db::name('role')->select();
        return $res;
    }
//    public function insert($data){
//        $res=Db::name('cate')->insert($data);
//        return $res;
//    }

}