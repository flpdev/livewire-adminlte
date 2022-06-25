<?php

namespace App\Http\Livewire\Partials;

use Livewire\Component;
use App\Models\Pages;

class Sidebar extends Component
{

    protected $listeners = [
        'refreshSidebar' => 'render',
    ];

    public $appName;

    public function render()
    {
        $this->appName = env('APP_NAME');
        
        $dados = [
            'pages' => Pages::where('situacao', '=', 1)->get(),
        ];
        return view('livewire.partials.sidebar')->with($dados);
    }
}
