<?php

namespace User\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        layout(false);
        echo '测试使用';
        //echo D('User/User','Service')->demo();
        $this->display();
    }
}