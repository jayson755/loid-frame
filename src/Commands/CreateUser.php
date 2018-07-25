<?php

namespace Loid\Frame\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loid:user {option} {name} {email} {password} {--super-admin}';

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
        try {
            if ($this->argument('option') == 'create') {
                $this->createUser($this->getArgument());
            } elseif ($this->argument('option') == 'update') {
                $this->updateUser();
            } else {
                throw new \Exception('未扩展');
            }
        } catch (\Exception $e) {
            echo "【{$this->description}】错误：{$e->getMessage()}";
        }

    }

    /**
     * @return array
     */
    private function getArgument(){
        return [
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => $this->argument('password'),
            'password_confirmation' => $this->argument('password')
        ];
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    private function createUser(array $data){
        if (DB::table('users')->count()) throw new \Exception('超级管理员已存在');
        $this->validator($data)->validate();
        new Registered($this->create($data));
    }

    /**
     * @throws \Exception
     */
    private function updateUser(){
        throw new \Exception('未扩展');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    private function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}