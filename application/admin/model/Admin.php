<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model{
    protected $pk = 'admin_id';
    public function roles()
    {


            return $this->hasMany('Role','role_id');

//        return $this->hasMany('Role','role_id');
    }


}