<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if(!User::where("email", "walisson@celke.com.br")->first()) {
            $superaAdmin = User::create([
                "name"=> "Walisson",
                "email"=> "walisson@celke.com.br",
                "password"=> Hash::make("123456a", ["rounds"=> "12"]),
            ]);
        }
        if(!User::where("email","cesar@celke.com.br")->first()) {
            $admin = User::create([
                "name"=> "Cesar",
                "email"=> "cesar@celke.com.br",
                "password"=> Hash::make("123456a", ["rounds"=> "12"]),
            ]);
        }
        if(!User::where("email","joaquim@celke.com.br")->first()) {
            $tutor = User::create([
                "name"=> "Joaquim",
                "email"=> "joaquim@celke.com.br",
                "password"=> Hash::make("123456a", ["rounds"=> "12"]),
            ]);
        }
        if(!User::where("email","jessica@celke.com.br")->first()) {
            $tutor = User::create([
                "name"=> "Jessica",
                "email"=> "jessica@celke.com.br",
                "password"=> Hash::make("123456a", ["rounds"=> "12"]),
            ]); 
        }
        if(!User::where("email","gabrielly@celke.com.br")->first()) {
            $student = User::create([
                "name"=> "Gabrielly",
                "email"=> "gabrielly@celke.com.br",
                "password"=> Hash::make("123456a", ["rounds"=> "12"]),
            ]);
        }
    }
}
