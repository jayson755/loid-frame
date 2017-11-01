<?php

namespace Loid\Frame\Controllers;

use Illuminate\Http\Request;

use Loid\Frame\Controllers\Controller;

class IndexController extends Controller{
    
    public function index(){
        
        return $this->view("{$this->view_prefix}/index/index", [
            'view_prefix' => $this->view_prefix,
            'menus' => config('permission.menus'),
            'user' => app()->auth->guard()->user()
        ]);
    }
    
    /**
     * 系统面板
     */
    public function panel(){
        return $this->view("{$this->view_prefix}/index/panel");
    }
}