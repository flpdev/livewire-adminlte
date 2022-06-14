<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;
use App\Models\Pages;

class Sidebar extends Component
{
    public function render()
    {
        $dados = [
            'pages' => Pages::where('situacao', '=', 1)->get(),
        ];

        return view('livewire.partials.sidebar')->with($dados);
    }
}
