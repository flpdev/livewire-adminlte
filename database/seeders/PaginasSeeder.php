<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pages;

class PaginasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paginas = [
            [
                'titulo' => 'Administrativo',
                'descricao' => 'Agrupador funções administrativas',
                'rota' => '',
                'icon' => 'fas fa-users-cog',
                'permissao' => 'administrativo-index',
                'situacao' => 1,
                'page_superior_id' => 0,
            ],
            [
                'titulo' => 'Papéis',
                'descricao' => 'Administração de papéis do sistema',
                'rota' => 'papeis',
                'icon' => 'fas fa-project-diagram',
                'permissao' => 'papeis-index',
                'situacao' => 1,
                'page_superior_id' => 1,
            ],
            [
                'titulo' => 'Permissões',
                'descricao' => 'Permissões do sistema',
                'rota' => 'permissoes',
                'icon' => 'fas fa-user-tag',
                'permissao' => 'permissoes-index',
                'situacao' => 1,
                'page_superior_id' => 1,
            ],
            [
                'titulo' => 'Usuários',
                'descricao' => 'Administração de usuários do sistema',
                'rota' => 'usuarios',
                'icon' => 'fas fa-users',
                'permissao' => 'usuarios-index',
                'situacao' => 1,
                'page_superior_id' => 1,
            ],
            [
                'titulo' => 'Páginas',
                'descricao' => 'Gerenciamento de menus (páginas)',
                'rota' => 'paginas',
                'icon' => 'fas fa-desktop',
                'permissao' => 'paginas-index',
                'situacao' => 1,
                'page_superior_id' => 1,
            ],
        ];

        foreach ($paginas as $pagina) {
            Pages::create($pagina);
        }
    }
}
