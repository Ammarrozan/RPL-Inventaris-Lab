<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $roleAslab = Role::where('nama', 'like', 'aslab')->first();
        $roleKalab = Role::where('nama', 'like', 'kalab')->first();


        if ($roleAslab) {
            User::updateOrCreate(
                ['email' => 'aslab@gmail.com'],
                [
                    'name'     => 'Ahmad Aslab',
                    'nim'      => 'AS12345',
                    'password' => Hash::make('password123'),
                    'role_id'  => $roleAslab->id,
                ]
            );
        }


        if ($roleKalab) {
            User::updateOrCreate(
                ['email' => 'kalab@gmail.com'],
                [
                    'name'     => 'Kalab',
                    'nim'      => 'KB54321',
                    'password' => Hash::make('password123'),
                    'role_id'  => $roleKalab->id,
                ]
            );
        }
    }
}
