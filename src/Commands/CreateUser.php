<?php

namespace Loid\Frame\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use DB;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loid:user {option} {username} {password} {--super-admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建超级管理员';
    

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        if ($this->argument('option') == 'create') {
            $this->createUser();
        } elseif ($this->argument('option') == 'update') {
            $this->updateUser();
        } else {
            exit('未扩展');
        }
    }
    
    private function createUser(){
        
    }
    
    private function updateUser(){
        
    }
}
