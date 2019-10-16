<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
use think\facade\Request;
use think\facade\Session;
use app\admin\controller\Common;
class Index extends Common
{
    public function index(){
//        dump($admin);exit;
        return view('index/index');
    }
    public function out(){
        Session::delete('user');
        return view('Login/login');
    }
}
