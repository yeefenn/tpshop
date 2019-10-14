<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class based extends Model
{
    public function select()
    {
        $res = Db::name('based')->select();
        return $res;
    }

    public function insert($data)
    {
        $res = Db::name('based')->insert($data);
        return $res;
    }
//    查询所有分类并排序
    public function orderCate($cate, $pid=0, $i = 0)
    {
        $order = [];
        foreach ($cate as $key => $val) {
            if ($val["based_pid"] == $pid) {
                $val['level'] = $i;
                $order[] = $val;
                $order = array_merge($order, $this->ordercate($cate, $val['based_id'], $i + 1));
            }
        }
       return $order;
    }
}