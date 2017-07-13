<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      $this->call('UserTableSeeder');
      $this->command->info('User Table Seeded!');
    }
}

class UserTableSeeder extends Seeder {
public function run()
{
DB::table('users')->delete();
DB::table('users')->insert([
    'email' => 'user1@gmail.com',
    'password' => Hash::make('123456'),
    'name' => 'Emma J.',
    'username' => 'test1',
    'photo' => '1.png',
    'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
    'email' => 'user2@gmail.com',
    'password' => Hash::make('123456'),
    'name' => 'Jackson M.',
    'username' => 'test2',
    'photo' => '2.png',
    'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
    'email' => 'user3@gmail.com',
    'password' => Hash::make('123456'),
    'name' => 'Olivia K.',
    'username' => 'test3',
    'photo' => '3.png',
    'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
    'email' => 'user4@gmail.com',
    'password' => Hash::make('123456'),
    'name' => 'Lucas G.',
    'username' => 'test4',
    'photo' => '4.png',
    'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
    'email' => 'user5@gmail.com',
    'password' => Hash::make('123456'),
    'name' => 'Steve J.',
    'username' => 'test5',
    'photo' => '5.png',
    'created_at' => date('Y-m-d H:i:s')
]);
}
}
