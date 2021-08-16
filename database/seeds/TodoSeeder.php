<?php

use App\Todo;
use App\TodoTask;
use App\User;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user) {
            $user->todos()->saveMany(
                factory( Todo::class, 10)->make()
 
            )->each(function($todo){
                $todo->tasks()->saveMany(
                     factory( TodoTask::class, 10)->make()
                );
            });

        });
    }

}
