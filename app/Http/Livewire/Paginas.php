<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use App\Models\Pages;

class Paginas extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $messages;

    public $idPagina;
    public $titulo, $descricao, $rota, $icon, $permissao, $situacao, $paginaSuperiorId;
    public $actionForm, $tituloModal, $pesquisar = '';

    public function rules()
    {
        $this->messages = [
            'titulo.required' => 'O campo título é obrigatório',
            'titulo.max' => 'O título da página deve ter no máximo 100 caracteres',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.max' => 'A descrição da página deve ter no máximo 100 caracteres',
            'rota.max' => 'A rota da página deve ter no máximo 100 caracteres',
            'icon.required' => 'O campo ícone é obrigatório',
            'icon.max' => 'O ícone da página deve ter no máximo 100 caracteres',
            'permissao.max' => 'A permissão da página deve ter no máximo 100 caracteres',
            'situacao.required' => 'O campo situação é obrigatório',
            'situacao.max' => 'A situação da página deve ter no máximo 100 caracteres',
            'paginaSuperiorId.required' => 'O campo menu superior é obrigatório',
        ];

        return [
            'titulo' => 'required|max:100',
            'descricao' => 'required|max:100',
            'rota' => 'max:100',
            'icon' => 'required|max:100',
            'permissao' => 'max:100',
            'situacao' => 'required',
            'paginaSuperiorId' => 'required',
        ];
    }

    public function render()
    {

        $pages = Pages::orWhere('titulo', 'like', '%' . $this->pesquisar . '%')
            ->orWhere('descricao', 'like', '%' . $this->pesquisar . '%')
            ->paginate(10);

        $dados = [
            'paginas' => $pages,
            'tituloModal' => $this->tituloModal,
            'idPagina' => $this->idPagina,
            'actionForm' => $this->actionForm,
        ];

        return view('livewire.paginas')->with($dados);
    }

    public function create()
    {
        $this->clearFields();
        $this->actionForm = 'store';
        $this->dispatchBrowserEvent('showModal');
        $this->tituloModal = 'Cadastrar Nova Página';
    }

    public function store()
    {
        $validado = $this->validate();
        $validado['page_superior_id'] = $validado['paginaSuperiorId'];
        
        try {
            Pages::create($validado);
            $this->emit('success', 'Página cadastrada com sucesso!');
        } catch (\Exception $e) {
            $this->emit('error', 'Erro ao cadastrar página!');
        }

        $this->clearFields();
        $this->dispatchBrowserEvent('hideModal');
        $this->emit('refreshSidebar');
    }

    public function edit($id)
    {
        $pagina = Pages::find($id);
        $this->clearFields();
        $this->alimentaInfoPagina($pagina);
        $this->actionForm = 'update';
        $this->tituloModal = 'Editar Página';
        $this->dispatchBrowserEvent('showModal');
    }

    public function update()
    {
        $validado = $this->validate();
        $validado['page_superior_id'] = $validado['paginaSuperiorId'];
        try {
            Pages::find($this->idPagina)->update($validado);
            $this->dispatchBrowserEvent('hideModal');
            $this->clearFields();
            session()->flash('success', 'Página atualizada com sucesso!');
        } catch (\Exception $e) {

            session()->flash('error', 'Erro ao atualizar página!' . $e->getMessage());
        }

        $this->clearFields();
        $this->dispatchBrowserEvent('hideModal');
        $this->emit('refreshSidebar');
    }


    public function clearFields()
    {
        $this->idPagina = '';
        $this->titulo = '';
        $this->descricao = '';
        $this->rota = '';
        $this->icon = '';
        $this->permissao = '';
        $this->situacao = '';
        $this->paginaSuperiorId = 0;
    }

    public function alimentaInfoPagina($pagina)
    {
        $this->idPagina = $pagina->id;
        $this->titulo = $pagina->titulo;
        $this->descricao = $pagina->descricao;
        $this->rota = $pagina->rota;
        $this->icon = $pagina->icon;
        $this->permissao = $pagina->permissao;
        $this->situacao = $pagina->situacao;
        $this->paginaSuperiorId = $pagina->page_superior_id;
    }    
}
