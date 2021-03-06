<?php

namespace app\admin\service;
use think\Model;

class Cat
{
    //查询所有分类并排序
    public function orderCate($cate, $pid=0, $i = 0)
    {
        $order = [];
        foreach ($cate as $key => $val) {
            if ($val["cate_pid"] == $pid) {
                $val['level'] = $i;
                $order[] = $val;
                $order = array_merge($order, $this->ordercate($cate, $val['cate_id'], $i + 1));
            }
        }
        return $order;
    }
}
