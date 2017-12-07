<?php

namespace Loid\Frame\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DB;

class MoudleInit{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        
        $this->bootMoudlesInit($request, $next);
        
        return $next($request);
    }
    
    /**
     *引导所有模块功能初始化
     */
    private function bootMoudlesInit($request, Closure $next){
        foreach (app()->moudle as $moudle) {
            call_user_func_array([$moudle->moudle_namespace . '\Init', 'moudleInit'], func_get_args());
        }
    }
}
