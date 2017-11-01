<?php

return [
    /*不用登陆就能访问的方法*/
    'no_login_method' => [],
    
    /*不用授权就能访问的类*/
    'no_auth_class' => [],
    
    /*不用授权就能访问的方法*/
    'no_auth_method' => [],
    
    /*菜单权限配置*/
    
    'menus' => [
        'user' => [
            'label' => '系统用户',
            'icon'  => 'fa-users',
            'menu'  => array(
                array('label' => '用户信息','display'=>true, 'alias' => 'manage.user', 'method' => 'get'),
                array('label' => '用户添加','display'=>false, 'alias' => 'manage.user.add', 'method' => 'get|post'),
                array('label' => '用户添加','display'=>false, 'alias' => 'manage.user.modify', 'method' => 'get|post'),
            ),
            
        ],
        //'settings' => array(
        //    'label' => '系统设置',
        //    'icon'  => 'fa-gears',
        //    'menu'  => array(
        //        array('label' => '配置设置','display'=>true, 'alias' => '', 'method' => 'get|post'),
        //        
        //       array('label' => '清除系统缓存','display'=>false, 'alias' => 'settings.clear.cache', 'method' => 'post'),
        //    ),
        //),
        
        
        
    ],
];