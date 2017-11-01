<?php
namespace Loid\Frame\Support;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Loid\Frame\Commands\Bootstrap as LoidBootstrap;
use Loid\Frame\Init as LoidInit;
use DB;

class ServiceProvider extends LaravelServiceProvider{
    
    
    /**
     * Bootstrap frame services.
     * 
     * @return void
     */
    public function boot(){
        
        $this->bootLoid(); //加载框架核心
        
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
    private function bootLoid(){
        $path = dirname(dirname(__DIR__));
        
        //合并核心配置文件
        $this->mergeConfig($path . '/config');
        
        if ($this->app->runningInConsole()) {
            //注册核心数据库迁移路径
            $this->loadMigrationsFrom($path . '/database/migrations');
            //注册核心install命令
            $this->commands([
                LoidBootstrap::class,
            ]);
        } else {
            //注册核心路由文件
            $this->loadRoutesFrom($path . '/routes/web.php');
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
        $moudles = DB::table('system_support_moudle')->where('moudle_status', 'on')->get();
        foreach ($moudles as $val) {
            if (false != $path = LoidInit::authMoudle($val->moudle_namespace . '\Init')) {
                //合并模块配置文件
                $this->mergeConfig($path . '/config');
                //注册模块路由文件
                $this->loadRoutesFrom($path . '/routes/web.php');
                //注册模块视图文件
                $this->loadViewsFrom($path . '/resources/views', $val->view_namespace);
            } else {
                $val->moudle_status = 'off';
                $val->save();
            }
        }
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
                if (is_array($val)) {
                    $this->app['config']->set("{$filename}.{$key}", array_merge($this->app['config']->get("{$filename}.{$key}") ?: [], $val));
                } else {
                    $this->app['config']->set("{$filename}.{$key}", $val);
                }
            }
        }
        $dir->close();
    }
}