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
        
        $this->bootMoudlesInit();
        
        return $next($request);
    }
    
    /**
     *引导所有模块功能初始化
     */
    private function bootMoudlesInit(){
        foreach (DB::table('system_support_moudle')->where('moudle_status', 'on')->get() as $moudle) {
            call_user_func(['Loid\Frame\Manager\Role\Init', 'moudleInit']);
        }
    }
}
