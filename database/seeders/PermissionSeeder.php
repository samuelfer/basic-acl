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
                ['name' => 'cadastrar_usuario'], ['name' => 'visualizar_usuario'], ['name' => 'editar_usuario'], ['name' => 'deletar_usuario'],
                ['name' => 'cadastrar_permissao'], ['name' => 'visualizar_permissao'], ['name' => 'editar_permissao'], ['name' => 'deletar_permissao'],
                ['name' => 'cadastrar_role'], ['name' => 'visualizar_role'], ['name' => 'editar_role'], ['name' => 'deletar_role'],
            ]
    );
    }
}
