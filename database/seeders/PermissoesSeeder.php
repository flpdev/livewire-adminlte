<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'administrativo-index',
                'description' => 'Permissão para visualização do menu administrativo',
            ],
            [
                'name' => 'papeis-index',
                'description' => 'Permissão para visualização do menu papeis',
            ],
            [
                'name' => 'permissoes-index',
                'description' => 'Permissão para visualização do menu permissões',
            ],
            [
                'name' => 'usuarios-index',
                'description' => 'Permissão para visualização do menu usuários',
            ],
            [
                'name' => 'paginas-index',
                'description' => 'Permissão para visualização do menu páginas',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
