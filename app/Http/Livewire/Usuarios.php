<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;    

class Usuarios extends Component
{

    use WithPagination;
    public $idUsuario; 
    public $name; 
    public $email; 
    public $password;
    public $admin;
    public $status;
    protected $usuarios;

    public $pesquisar = '', $actionForm, $tituloModal, $messages;
    protected $paginationTheme = 'bootstrap'; 
    
    public function render()
    {

        $this->usuarios = User::where('admin', '!=', 1)
                            ->orWhere('name', 'like', '%' . $this->pesquisar . '%')
                            ->orWhere('email', 'like', '%' . $this->pesquisar . '%')
                            ->paginate(10);

        $dados = [
            'usuarios' => $this->usuarios,
            'tituloModal' => $this->tituloModal,
            'idUsuario' => $this->idUsuario,
            'actionForm' => $this->actionForm,
        ];

        return view('livewire.usuarios')->with($dados);
    }

    public function create(){
        $this->clearFields();
        $this->actionForm = 'store';
        $this->dispatchBrowserEvent('showModal');
        $this->tituloModal = 'Cadastrar Novo Usuário';
    }

    public function clearFields(){
        $this->idUsuario = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->admin = '';
        $this->status = '';
    }


}
