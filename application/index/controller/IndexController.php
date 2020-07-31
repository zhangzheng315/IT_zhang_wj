<?php
namespace app\index\controller;

use app\common\model\Images;
use app\common\model\Product;
use app\common\model\System;
use app\common\services\index\IndexBaseController;
use think\Controller;

class IndexController extends  IndexBaseController
{
    public function index()
    {

        return view('index');
    }
}
