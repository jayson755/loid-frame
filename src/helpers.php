<?php

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
