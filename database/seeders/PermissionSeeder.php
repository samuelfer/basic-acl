<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert(
            [
                ['name' => 'users.view'], ['name' => 'users.edit'], ['name' => 'users.create'], ['name' => 'users.store'], 
                ['name' => 'users.edit'], ['name' => 'users.update'], ['name' => 'users.delete'],
                ['name' => 'permissions.view'], ['name' => 'permissions.edit'], ['name' => 'permissions.create'], 
                ['name' => 'permissions.store'], ['name' => 'permissions.edit'], ['name' => 'permissions.update'], ['name' => 'permissions.delete'],
                ['name' => 'roles.view'], ['name' => 'roles.edit'], ['name' => 'roles.create'], ['name' => 'roles.store'], 
                ['name' => 'roles.edit'], ['name' => 'roles.update'], ['name' => 'roles.delete'],
            ]
        );
    }
}
