<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model{
    protected $pk = 'admin_id';
    public function roles()
    {
        return $this->belongsToMany('Role','admin_role','role_id','admin_id');
    }


}