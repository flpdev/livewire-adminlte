<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class PapeisPermissoes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pesquisar = '';
    public $idPapel;
    public $papel;
    public $permissoesHabilitadasTela = array();

    public function mount($idPapel){
        $this->idPapel = $idPapel;
    }


    public function render()
    {
        $this->papel = Role::find($this->idPapel);

        Role::where('name', 'like', '%' . $this->pesquisar . '%')->paginate(10);

        $this->sincronizaPermissoesPapel();
        $this->permissoesHabilitadasTela = $this->papel->permissions->pluck('name')->toArray();

        $dados = [
            'papel' => $this->papel,
            'permissoes' => Permission::where('name', 'like', '%' . $this->pesquisar . '%')->paginate(10),
            'permissoesHabilitadas' => $this->permissoesHabilitadasTela
        ];

        return view('livewire.papeis-permissoes')->with($dados);
    }

    public function sincronizaPermissoesPapel(){
        if(sizeOf($this->permissoesHabilitadasTela) > 0){
            $this->papel->syncPermissions($this->permissoesHabilitadasTela);
        }
        $this->emit('refreshSidebar');
    }

}
