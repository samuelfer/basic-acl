<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $userAdmin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'name' => 'Teste',
            'email' => 'teste@gmail.com',
            'is_admin' => 0,
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        
        $roles = Role::all();

        $userAdmin->roles()->saveMany($roles);

    }
}
