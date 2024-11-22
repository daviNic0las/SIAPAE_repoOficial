<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' =>  'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('333729015'),
            'access_level' => 'admin',
         ]);

         User::create([
            'name' =>  'Kelvia',
            'email' => 'kelvia@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'admin',
         ]);

         User::create([
            'name' =>  'Sâmia',
            'email' => 'samia@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
         ]);

         User::create([
            'name' =>  'Isadélia',
            'email' => 'tica@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
         ]);

         User::create([
            'name' =>  'Glaúcia',
            'email' => 'glaucia@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
         ]);
    }
}