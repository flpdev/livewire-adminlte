<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;


class Papeis extends Component
{
    use WithPagination;
    public $idPapel;
    public $name;
    public $description;
    public $pesquisar = '';
    public $actionForm;
    public $tituloModal;
    protected $paginationTheme = 'bootstrap';

    protected $messages;

    protected function rules()
    {
        $this->messages = [
            'name.required' => 'O campo nome é obrigatorio',
            'name.unique' => 'O nome do papel já existe',
            'name.max' => 'O nome do papel deve ter no máximo 100 caracteres',
            'description.required' => 'O campo descrição é obrigatorio',
            'description.max' => 'O descrição do papel deve ter no máximo 100 caracteres',
        ];

        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('roles')->ignore($this->idPapel)],
            'description' => 'required|string|max:100',
        ];
    }

    public function render()
    {
        $papeis = Role::orWhere('name', 'like', '%' . $this->pesquisar . '%')
                        ->orWhere('description', 'like', '%' . $this->pesquisar . '%')
                        ->paginate(10);

        $dados = [
            'papeis' => $papeis,
            'tituloModal' => $this->tituloModal,
            'idPapel' => $this->idPapel,
            'actionForm' => $this->actionForm,
        ];
        return view('livewire.papeis')->with($dados);
    }

    public function create()
    {
        $this->clearFields();
        $this->actionForm = 'store';
        $this->dispatchBrowserEvent('showModal');
        $this->tituloModal = 'Cadastrar Novo Papel';
    }

    public function store()
    {

        $validado = $this->validate();
        try {
            Role::create($validado);
            session()->flash('success', 'Papel cadastrado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->dispatchBrowserEvent('hideModal');
        $this->clearFields();
    }

    public function permissions($idPapel)
    {
        return redirect()->route('papeis-permissoes', $idPapel);
    }

    public function edit($idPapel)
    {
        $this->clearFields();

        $papel = Role::find($idPapel);
        $this->idPapel = $papel->id;
        $this->name = $papel->name;
        $this->description = $papel->description;
        $this->actionForm = 'update';
        $this->dispatchBrowserEvent('showModal');
        $this->tituloModal = 'Editar Papel';
    }

    public function update()
    {
        $validado = $this->validate();
        try {
            $papel = Role::find($this->idPapel);
            $papel->update($validado);
            $this->dispatchBrowserEvent('hideModal');
            $this->clearFields();
            session()->flash('success', 'Papel atualizado com sucesso!');
        } catch (\Throwable $th) {
        }
    }

    public function delete($idPapel)
    {
    }

    public function clearFields()
    {
        $this->name = null;
        $this->description = null;
    }
}
