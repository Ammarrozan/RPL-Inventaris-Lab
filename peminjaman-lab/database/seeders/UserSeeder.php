<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'radit',
                'email' => 'radit@gmail.com',
                'password' => '$2y$12$qI.hh52uPVqs3M9roKF5BOOoJXIz8.Ge/1H4nXkf/hsOBgawZ8uKe',
                'no_hp' => '-',
                'id_role' => 4,
            ],
            [
                'id' => 2,
                'name' => 'aslabbaru',
                'email' => 'baru@gmail.com',
                'password' => '$2y$12$8JZHWGRnw/xmyfsR0VLgqeZhzRIDf21vsMmVwiODpZ1kL08QsKRhC',
                'no_hp' => '-',
                'id_role' => 2,
            ],
            [
                'id' => 3,
                'name' => 'kuyy',
                'email' => 'kuy@gmail.com',
                'password' => '$2y$12$p5dOx3zAQ4P5gQWH.gx02.mmnSKp.IGLMHNAXmkqtshukMYqzcUnG',
                'no_hp' => '-',
                'id_role' => 2,
            ],
            [
                'id' => 4,
                'name' => 'yanto',
                'email' => 'yanto@mail.com',
                'password' => '$2y$12$RM9aF4AVVUsO4WAMy55S1uFetxnsGJH0HIdQAJqvPTvH5NOjyvraW',
                'no_hp' => '-',
                'id_role' => 4,
            ],
            [
                'id' => 5,
                'name' => 'asya',
                'email' => 'asya@gmail.com',
                'password' => '$2y$12$RE7Cu15/uP0eN8rQfitje.LYZ28d8zL5e8sdN.A8ZSJZN8TtrM7ZG',
                'no_hp' => '-',
                'id_role' => 4,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
