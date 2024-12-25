<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
  public function run(): void
  {
    $userData = [
        [
          'nama' => 'hadiiyok',
          'email' => 'hadiiyok@gmail.com',
          'role' => 'admin',
          'password' => bcrypt('12345678')
        ],
        [
          'nama' => 'user',
          'email' => 'user@gmail.com',
          'role' => 'masyarakat',
          'password' => bcrypt('12345678')
        ]
      ];
    
    foreach($userData as $key => $value){
      User::create($value);
    }
  }
}