<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Role extends Model{
    protected $pk = 'role_Id';

    public function admin()
    {
        return $this->belongsTo('admin');
    }
}