<?php

if (!function_exists('get_route_middleware')) {
    /**
     * 获取模块的路由中间件
     */
    function get_route_middleware(){
        
    }
}

if (!function_exists('asset_site')) {
    
    //使用当前请求的 scheme（HTTP或HTTPS）为前端资源生成一个css URL
    
    function asset_site(string $path, string $sign, string $filename){
        switch ($sign) {
            case 'plugin':
                $middle = 'plugins';
                break;
            case 'js':
                $middle = config('view.default.theme') . '/js';
                break;
            case 'css':
            default:
                $middle = config('view.default.theme') . '/css';
                break;
        }
        return asset("{$path}/static/{$middle}/{$filename}");
        
    }
}

if (!function_exists('is_mobile')) {
    /**
     * 验证电话号码
     */
    function is_mobile(string $str){
        if (11 !== strlen($str)) return false;
        return true;
    }
}



if (!function_exists('get_val_by_Key')) {
    /**
     * 根据数组某字段为键值返回数据
     */
    function get_val_by_Key($field = false, $data, $valueField = false){
        if (false === $field && false === $valueField) {
            return $data;
        }
        $new_array = array();
        foreach ($data as $val) {
            $val = (array)$val;
            if (false === $field) {
                $new_array[] = $val[$valueField];
            } else {
                if (false === $valueField) {
                    $new_array[$val[$field]] = $val;
                } else {
                    $new_array[$val[$field]] = $val[$valueField];
                }
            }
        }
        return $new_array;
    }
}