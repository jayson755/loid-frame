<?php

namespace Loid\Frame\Commands;

use Loid\Frame\Init as LoidInit;
use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use DB;

class Bootstrap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loid:boot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化引导';
    

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = dirname(dirname(__DIR__));
        $moudles = json_decode(file_get_contents($path . '/storage/moudle_setting.json'));
        foreach ($moudles as $moudle) {
            if (false == $moudlePath = LoidInit::authMoudle($moudle->moudle_namespace . '\Init')) {
                continue;
            }
            $this->laravel['migrator']->path("{$moudlePath}/database/migrations");
        }
        $this->call('migrate');
        $this->initMoudlesData($moudles);
    }
    
    /**
     * init moudles data in table system_support_moudle
     * @param $moudles
     * @return void
     */
    private function initMoudlesData($moudles){
        foreach ($moudles as $moudle) {
            if (! DB::table('system_support_moudle')->where('moudle_sign', $moudle->moudle_sign)->count()) {
                DB::table('system_support_moudle')->insert((array)$moudle);
            }
        }
    }
    
}
