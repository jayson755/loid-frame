<?php

namespace Loid\Frame\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Laravel;
use DB;
use Log;
class Controller extends Laravel{
    
    protected $view_base_prefix = null;
    
    protected $view_prefix = null;
    
    protected $rows = 20;
    
    public function __construct(){
        DB::connection()->enableQueryLog();
        $this->view_base_prefix = $this->view_prefix = config('view.default.namespace') . '::' . config('view.default.theme') . DIRECTORY_SEPARATOR;
    }
    
    public function __destruct(){
        Log::info(DB::getQueryLog());
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
        $base_resource = str_replace(dirname(request()->server('DOCUMENT_ROOT')) , '', str_replace('/vendor', '', dirname(dirname(__DIR__))));
        $resource = str_replace(dirname(request()->server('DOCUMENT_ROOT')) , '', str_replace('/vendor', '', dirname(dirname(dirname((new \ReflectionClass(get_called_class()))->getFileName())))));
        return view($view, array_merge($data, ['view_base_prefix'=>$this->view_base_prefix, 'base_resource'=>"theme{$base_resource}",'resource'=>"theme{$resource}"]), $mergeData);
    }
    
    /**
     * 获取 jqGrid 列表
     *
     */
    public function getjQGridList(Request $request, $param){
        if (!method_exists($this, '_getList')) {
            return response()->json(['code' => 0, 'msg' => '无该查找']);
        }
        return response()->json(call_user_func_array([$this, '_getList'], func_get_args($param)));
    }
    
    /**
     * 组织response
     */
    public function response(bool $success, string $url = '', string $msg = '操作成功', array $data = []){
        $code = 0;
        if (true === $success) {
            $code = 1;
        }
        return response()->json(compact('code', 'url', 'msg', 'data'));
    }
}