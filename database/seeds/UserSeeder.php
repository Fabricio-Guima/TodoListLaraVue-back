<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( User::class)->create([
            'first_name' => 'Fabrício',
            'last_name' => 'Guimarães',
            'email' => 'fsgkof@gmail.com',
            'password' => bcrypt('123')
           
        ]);

        factory( User::class, 5)->create();
    }
}
