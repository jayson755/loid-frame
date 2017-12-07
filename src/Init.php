<?php
namespace Loid\Frame;
use DB;
use Closure;

class Init{
    
    /**
     * 验证模块是否合法
     * @param string $class
     * return string class path
     */
    final public static function authMoudle(string $class){
        if (!class_exists($class)) return false;
        
        $object = new \ReflectionClass($class);
        
        if (__CLASS__ != $object->getParentClass()->name) return false;
        
        return dirname(dirname($object->getFileName()));
    }
    
    /**
     *模块功能数据初始化
     */
    public static function moudleInit($request, Closure $next){}
    
}