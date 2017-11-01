<?php

namespace Loid\Frame\Controllers;

use Illuminate\Http\Request;

use Loid\Frame\Controllers\Controller;
use Loid\Frame\Manager\Role\Model\ManagerRole;
use Loid\Frame\Support\JqGrid;
use DB;

class UserController extends Controller{
    
    
    public function index(){
        
        $test = JqGrid::instance(['model'=> DB::table('users'),'vagueField'=>['name','email'],'filtField'=>['password', 'remember_token']])->query(['name|like'=>'1%']);
        print_r($test);die;
        die;
        return $this->view("{$this->view_prefix}/user/index", [
            'view_prefix' => $this->view_prefix,
            'users' => DB::table('users')->select('id','name','email','created_at')->where('id', '<>', app()->auth->guard()->user()->id)->get(),
            'roule' => ManagerRole::get()
        ]);
    }
    
    public function _getList(){
        
    }
    
    public function add(){
        
    }
    
    public function modify(){
        
    }
}