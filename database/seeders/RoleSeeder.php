<?php

namespace Database\Seeders;

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
        DB::table('roles')->insert([
                ['name' => 'master', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'consulta', 'created_at' => now(), 'updated_at' => now()]
            ],
        );
    }
}
