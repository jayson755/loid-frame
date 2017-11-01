<?php

namespace Loid\Frame\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Laravel;

class Controller extends Laravel{
    
    protected $view_prefix = null;
    
    public function __construct(){
        
        $this->view_prefix = config('view.default.namespace') . '::' . config('view.default.theme');
        
    }
    
    /**
     * 返回类的文件路径
     */
    protected static function getFilePath(){
        return __DIR__;
    }
    
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view($view = null, $data = [], $mergeData = []){
        
        $resource = str_replace(dirname(request()->server('DOCUMENT_ROOT')) , '', str_replace('/vendor', '', dirname(dirname($this->getFilePath()))));
        
        return view($view, array_merge($data, ['resource'=>"theme{$resource}"]), $mergeData);
    }
    
    /**
     * 获取 jqGrid 列表
     *
     */
    public function getjQGridList($param){
        if (!method_exists($this, '_getList')) {
            return json(['code' => 0, 'msg' => '无该查找']);
        }
        return json(call_user_func_array([$this, '_getList'], func_get_args($param)));
    }
    
}