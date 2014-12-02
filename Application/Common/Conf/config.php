<?php
$appConfig = array(
    // 调试页
    'SHOW_PAGE_TRACE' =>true,
    // 默认模块和Action
    'MODULE_ALLOW_LIST' => array('Home', 'Admin', 'Api', 'Doctor', 'Hospital', 'Phone', 'Tieba', 'User'),
    'DEFAULT_MODULE' => 'Home',
    // 默认控制器
    'DEFAULT_CONTROLLER' => 'Index',
    // 分页列表数
    'PAGE_LIST_ROWS' => 10,
    // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout',
    // 文件上传根目录
    'UPLOAD_ROOT' => 'Public/uploads/',
    // 系统公用配置目录
    'COMMON_CONF_PATH' => WEB_ROOT . 'Common/Conf/'
    
);

return array_merge($appConfig);
