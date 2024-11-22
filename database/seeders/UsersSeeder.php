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
            'name' =>  'Kelvia Maria Gonçalves Viana',
            'email' => 'kelvia.mgv@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'admin',
         ]);

         User::create([
            'name' =>  'Sâmia Maria Gonçalves Viana da Silva',
            'email' => 'samiamariagoncalves@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
         ]);

         User::create([
            'name' =>  'Francisca Isadélia da Silva Nogueira',
            'email' => 'isadelianogueira@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
         ]);

         User::create([
            'name' =>  'Gláucia Lopes de Lima Bezerra',
            'email' => 'glaucialopesbezerra@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
         ]);
    }
}