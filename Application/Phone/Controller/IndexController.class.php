<?php

namespace Phone\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        echo '测试使用';
    }
}