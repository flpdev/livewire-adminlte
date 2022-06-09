<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class Permissoes extends Component
{

    use WithPagination;
    public $idPermissao, $name, $description, $pesquisar = '', $actionForm, $tituloModal;
    protected $paginationTheme = 'bootstrap';
    protected $messages;

    protected function rules()
    {
        $this->messages = [
            'name.required' => 'O campo nome é obrigatorio',
            'name.unique' => 'O nome da permissão já existe',
            'name.max' => 'O nome da permissão deve ter no máximo 100 caracteres',
            'description.required' => 'O campo descrição é obrigatorio',
            'description.max' => 'O descrição da permissão deve ter no máximo 100 caracteres',
        ];

        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('permissions')->ignore($this->idPermissao)],
            'description' => 'required|string|max:100',
        ];
    }

    public function render()
    {
        $permissoes = Permission::where('name', 'like', '%' . $this->pesquisar . '%')->paginate(10);

        $dados = [
            'permissoes' => $permissoes,
            'tituloModal' => $this->tituloModal,
            'idPermissao' => $this->idPermissao,
            'actionForm' => $this->actionForm,
        ];

        return view('livewire.permissoes')->with($dados);
    }

    public function create()
    {
        $this->clearFields();
        $this->actionForm = 'store';
        $this->dispatchBrowserEvent('showModal');
        $this->tituloModal = 'Cadastrar Nova Permissão';
    }

    public function store()
    {
        $validado = $this->validate();
        try {
            Permission::create($validado);
            session()->flash('success', 'Permissão cadastrada com sucesso!');
        } catch (\Throwable $th) {
            dd($th);
        }

        $this->dispatchBrowserEvent('hideModal');
        $this->clearFields();
    }

    public function show($idPermissao){

    }

    public function edit($idPermissao){

    }

    public function update(){
        $validado = $this->validado();
        try {
            $permissao = Permission::find($this->idPermissao);
            $permissao->update($validado);
            $this->dispatchBrowserEvent('hideModal');
            $this->clearFields();
            session()->flash('success', 'Permissão atualizada com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function delete($idPermissao){

    }

    public function clearFields()
    {
        $this->name = null;
        $this->description = null;
    }

}
