<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Service;

/**
 * 用户操作
 * 
 */
class UserService
{

    //定义session 键名
    private $LoginArray = array(
        'Home' => 'UserHome',
        'Hospital' => 'UserHospital'
    );

    public function demo()
    {
        return '测试';
    }

    /*
     * 
     */
}
