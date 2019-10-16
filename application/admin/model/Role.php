<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Role extends Model{
    protected $pk = 'role_id';
    public function baseds()
    {
        return $this->belongsToMany('Based','role_based','based_id','role_id');
    }

}