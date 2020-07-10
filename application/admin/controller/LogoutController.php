<?php


namespace app\admin\controller;


use think\Controller;

class LogoutController extends Controller
{
    public function index()
    {
        session('user',null);
        $this->redirect('index/index');
    }
}