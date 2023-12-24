<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $role = Role::create(
                ['name' => 'master', 'created_at' => now(), 'updated_at' => now()]
        );

        $permissions = Permission::all();

        $role->permissions()->saveMany($permissions);
    }
}
