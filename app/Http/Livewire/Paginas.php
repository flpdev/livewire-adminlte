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

    public $idPage;
    public $titulo, $descricao, $rota, $icon, $permissao, $situacao;
    public $actionForm, $tituloModal, $pesquisar = '';

    public function rules(){
        $this->messages = [
            'titulo.required' => 'O campo título é obrigatório',
            'titulo.max' => 'O título da página deve ter no máximo 100 caracteres',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.max' => 'A descrição da página deve ter no máximo 100 caracteres',
            'rota.required' => 'O campo rota é obrigatório',
            'rota.max' => 'A rota da página deve ter no máximo 100 caracteres',
            'icon.required' => 'O campo ícone é obrigatório',
            'icon.max' => 'O ícone da página deve ter no máximo 100 caracteres',
            'permissao.required' => 'O campo permissão é obrigatório',
            'permissao.max' => 'A permissão da página deve ter no máximo 100 caracteres',
            'situacao.required' => 'O campo situação é obrigatório',
            'situacao.max' => 'A situação da página deve ter no máximo 100 caracteres',
        ];

        return [
            'titulo' => 'required|string|max:100',
            'descricao' => 'required|string|max:100',
            'rota' => 'required|string|max:100',
            'icon' => 'required|string|max:100',
            'permissao' => 'required|string|max:100',
            'situacao' => 'required|string|max:100',
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
            'idPage' => $this->idPage,
            'actionForm' => $this->actionForm,
        ];  

        return view('livewire.paginas')->with($dados);
    }

    public function create(){
        $this->clearFields();
        $this->actionForm = 'store';
        $this->dispatchBrowserEvent('showModal');
        $this->tituloModal = 'Cadastrar Nova Página';
    }

    public function store(){
        
    }

    public function edit($id){
        $pagina = Pages::find($id);
        $this->clearFields();
        $this->alimentaInfoPagina($pagina);
        $this->actionForm = 'update';
        $this->tituloModal = 'Editar Página';
        $this->dispatchBrowserEvent('showModal');
    }

    public function update(){
        $pagina = Pages::find($this->idPage);
        $pagina->titulo = $this->titulo;
        $pagina->descricao = $this->descricao;
        $pagina->rota = $this->rota;
        $pagina->icon = $this->icon;
        $pagina->permissao = $this->permissao;
        $pagina->situacao = $this->situacao;
        $pagina->save();
        $this->clearFields();
        $this->dispatchBrowserEvent('hideModal');
    }
    

    public function clearFields(){
        $this->titulo = '';
        $this->descricao = '';
        $this->rota = '';
        $this->icon = '';
        $this->permissao = '';
        $this->situacao = '';
    }

    public function alimentaInfoPagina($pagina){
        $this->titulo = $pagina->titulo;
        $this->descricao = $pagina->descricao;
        $this->rota = $pagina->rota;
        $this->icon = $pagina->icon;
        $this->permissao = $pagina->permissao;
        $this->situacao = $pagina->situacao;
    }
}
