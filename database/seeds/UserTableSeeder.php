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
'name' => 'user1',
'type' => '1',
'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
'email' => 'user2@gmail.com',
'password' => Hash::make('123456'),
'name' => 'user2',
'type' => '1',
'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
'email' => 'user3@gmail.com',
'password' => Hash::make('123456'),
'name' => 'user3',
'type' => '1',
'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
'email' => 'user4@gmail.com',
'password' => Hash::make('123456'),
'name' => 'user4',
'type' => '1',
'created_at' => date('Y-m-d H:i:s')
]);
DB::table('users')->insert([
'email' => 'user5@gmail.com',
'password' => Hash::make('123456'),
'name' => 'user5',
'type' => '1',
'created_at' => date('Y-m-d H:i:s')
]);
}
}
