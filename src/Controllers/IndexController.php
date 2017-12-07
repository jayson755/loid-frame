<?php

namespace Loid\Frame\Controllers;

use Illuminate\Http\Request;

use Loid\Frame\Controllers\Controller;

class IndexController extends Controller{
    
    public function index(Request $request){
        return $this->view("{$this->view_prefix}/index/index", [
            'view_prefix' => $this->view_prefix,
            'menus' => $request->session()->has('user_menus') ? $request->session('user_menus') : config('permission.menus'),
            'user' => \Auth::user()
        ]);
    }
    
    /**
     * 系统面板
     */
    public function panel(){
        return $this->view("{$this->view_prefix}/index/panel");
    }
    
    /**
     * 登出
     */
    public function logout(Request $request){
        \Auth::guard()->logout();
        $request->session()->invalidate();
        return response()->json(['code'=>1]);
    }
    
    /**
     * 清除缓存
     */
    public function clear(){
        return response()->json(['code'=>1]);
    }
}