<?php
namespace Loid\Frame\Support;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Loid\Frame\Commands\Bootstrap as LoidBootstrap;
use Loid\Frame\Init as LoidInit;
use DB;
use Route;

class ServiceProvider extends LaravelServiceProvider{
    
    
    /**
     * Bootstrap frame services.
     * 
     * @return void
     */
    public function boot(Request $request){
        $this->bootLoid($request); //加载框架核心
        
    }
    
    /**
     * Register frame services.
     *
     * @return void
     */
    public function register(){
        //
    }
    
    /**
     * 引导框架核心
     */
    private function bootLoid(Request $request){
        $path = dirname(dirname(__DIR__));
        
        //合并核心配置文件
        $this->mergeConfig($path . '/config');
        
        if ($this->app->runningInConsole()) {
            //注册核心数据库迁移路径
            $this->loadMigrationsFrom($path . '/database/migrations');
            //注册核心install命令
            if ($request->server()['argv'][1] == 'loid:boot') {
                $this->commands([
                    LoidBootstrap::class,
                ]);
            } else {
                //引导模块
                $this->bootMoudles();
            }
            
        } else {
            //注册核心路由文件
            $this->loadRoutesFrom($path . '/routes/web.php');
            
            if (file_exists($path . '/routes/api.php')) {
                Route::prefix('api')
                ->middleware('api')
                ->group($path . '/routes/api.php');
            }
            //注册核心视图文件
            $this->loadViewsFrom($path . '/resources/views', config('view.default.namespace'));
            
            //引导模块
            $this->bootMoudles();
        }
        
    }
    
    /**
     * 引导模块
     */
    private function bootMoudles(){
        $moudle = [];
        foreach (DB::table('system_support_moudle')->where('moudle_status', 'on')->get() as $val) {
            if (false != $path = LoidInit::authMoudle($val->moudle_namespace . '\Init')) {
                //合并模块配置文件
                $this->mergeConfig($path . '/config');
                if ($this->app->runningInConsole()) {
                    //注册模块自定义命令
                    $this->commands($this->app['config']->get('commands'));
                } else {
                    //注册模块路由文件
                    if (file_exists($path . '/routes/web.php')) {
                        $this->loadRoutesFrom($path . '/routes/web.php');
                    }
                    if (file_exists($path . '/routes/api.php')) {
                        Route::prefix('api')
                        ->middleware('api')
                        ->group($path . '/routes/api.php');
                    }
                    //注册模块视图文件
                    $this->loadViewsFrom($path . '/resources/views', $val->view_namespace);
                    
                    $moudle[$val->moudle_sign] = $val;
                }
            } else {
                DB::table('system_support_moudle')->where('moudle_id', $val->moudle_id)->update(['moudle_status'=>'off']);
            }
        }
        
        $this->app->moudle = $moudle;
    }
    
    /**
     *  合并框架配置文件
     *
     *  为不影响laravel源配置文件结构，特定采用合并方式重置配置，parent::mergeConfigFrom不能合并多维数组
     *
     *  @return void
     */
    private function mergeConfig(string $path){
        $dir = dir($path);
        while (false !== $file = $dir->read()) {
            if ($file == '.' || $file == '..') continue;
            $filename = pathinfo($file, PATHINFO_FILENAME);
            foreach (include_once($path . '/' . $file) as $key => $val) {
                if ('aliases' === $filename) {
                    class_alias($val, $key); //为类设置别名
                }
                if (is_array($val)) {
                    $this->app['config']->set("{$filename}.{$key}", $val + ($this->app['config']->get("{$filename}.{$key}") ?? []));
                } else {
                    $this->app['config']->set("{$filename}.{$key}", $val);
                }
            }
        }
        $dir->close();
    }
}