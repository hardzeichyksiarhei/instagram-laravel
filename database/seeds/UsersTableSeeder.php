<?php

use App\User;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        User::create([
          'email' => 'admin@admin.admin',
          'password' => Hash::make('123456'),
          'balans' => 50000,
          'is_admin' => 1
        ]);

        User::create([
          'email' => 'user@user.user',
          'password' => Hash::make('123456'),
          'balans' => 50000,
          'is_admin' => 0
        ]);
    }
}
