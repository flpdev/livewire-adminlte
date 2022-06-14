<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pages;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'titulo' => 'Papeis',
                'descricao' => 'Menu Papeis',
                'rota'  => 'papeis',
                'icon' => 'home',
                'permissao' => null,
                'situacao' => 1,
                'page_superior_id' => null,
            ],
            [
                'titulo' => 'Permissões',
                'descricao' => 'Menu Permissões',
                'rota'  => 'permissoes',
                'icon' => 'home',
                'permissao' => null,
                'situacao' => 1,
                'page_superior_id' => null,
            ],
            [
                'titulo' => 'Usuários',
                'descricao' => 'Menu Usuários',
                'rota'  => 'usuarios',
                'icon' => 'home',
                'permissao' => null,
                'situacao' => 1,
                'page_superior_id' => null,
            ],
        ];

        foreach ($pages as $page) {
            Pages::create($page);
        }

    }
}
