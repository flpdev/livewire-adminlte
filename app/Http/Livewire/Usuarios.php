<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class Usuarios extends Component
{

    use WithPagination;
    public $idUsuario;
    public $name;
    public $email;
    public $password;
    public $admin;
    public $status;
    public $papeisUsuario = [];
    protected $usuarios;
    public $papeisRestantes = [];
    public $papelInserir;

    public $pesquisar = '', $actionForm, $tituloModal, $messages;
    protected $paginationTheme = 'bootstrap';

    public function rules()
    {
        $this->messages = [
            'name.required' => 'O campo nome é obrigatorio',
            'name.max' => 'O nome do usuário deve ter no máximo 100 caracteres',
            'email.unique' => 'O nome do usuário já existe',
            'email.required' => 'O campo email é obrigatorio',
            'email.email' => 'O campo email deve ser um email válido',
            'email.max' => 'O email do usuário deve ter no máximo 100 caracteres',
            'password.required' => 'O campo senha é obrigatorio',
        ];

        return [
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore($this->idUsuario)],
            'password' => [Rule::requiredIf(!$this->idUsuario)],
        ];
    }

    public function render()
    {
        Gate::authorize('usuarios-index');
        $this->usuarios = User::where('admin', '!=', 1)
            ->orWhere('name', 'like', '%' . $this->pesquisar . '%')
            ->orWhere('email', 'like', '%' . $this->pesquisar . '%')
            ->paginate(10);

        $dados = [
            'usuarios' => $this->usuarios,
            'tituloModal' => $this->tituloModal,
            'idUsuario' => $this->idUsuario,
            'actionForm' => $this->actionForm,
            'papeisUsuario' => $this->papeisUsuario,
            'papeisRestantes' => $this->papeisRestantes,
        ];

        return view('livewire.usuarios')->with($dados);
    }

    public function create()
    {
        $this->clearFields();
        $this->actionForm = 'store';
        $this->dispatchBrowserEvent('showModal');
        $this->tituloModal = 'Cadastrar Novo Usuário';
    }

    public function store()
    {
        $this->validate();
        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'admin' => 0,
                'status' => 1,
            ]);
            session()->flash('success', 'Usuário cadastrado com sucesso!');
        } catch (\Throwable $th) {
            dd($th);
        }
        $this->dispatchBrowserEvent('hideModal');
        $this->clearFields();
    }

    public function edit($idUsuario)
    {
        $usuario = User::find($idUsuario);
        $this->clearFields();

        $this->alimentaInfoUsuario($usuario);

        $this->actionForm = 'update';
        $this->tituloModal = 'Editar Usuário';
        $this->dispatchBrowserEvent('showModal');
    }

    public function update()
    {
        $this->validate();

        try {
            User::find($this->idUsuario)->update([
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
            ]);

            session()->flash('success', 'Usuário atualizado com sucesso!');
            $this->dispatchBrowserEvent('hideModal');
            $this->clearFields();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function papeisUsuario($idUsuario)
    {
        $this->alimentaInfoUsuario(User::find($idUsuario));
        $this->papeisRestantes = Role::all()->diff($this->papeisUsuario);
        $this->tituloModal = 'Papeis vinculados a este usuário';
        $this->dispatchBrowserEvent('showPapeisModal');
    }

    public function adicionarPapelUsuario()
    {
        if (!$this->papelInserir) {
            session()->flash('error-select-papel', 'É necessário selecionar uma opção válida');
        } else {
            $usuario = User::find($this->idUsuario)->assignRole($this->papelInserir);
            $this->alimentaInfoUsuario($usuario);
        }
        $this->papelInserir = '';
    }

    public function papelRemover($papelName)
    {
        $usuario = User::find($this->idUsuario)->removeRole($papelName);
        $this->alimentaInfoUsuario($usuario);
    }

    public function clearFields()
    {
        $this->idUsuario = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->admin = '';
        $this->status = '';
    }

    public function alimentaInfoUsuario($usuario)
    {
        $this->idUsuario = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->admin = $usuario->admin;
        $this->status = $usuario->status;
        $this->papeisUsuario = $usuario->roles;
        $this->papeisRestantes = Role::all()->diff($this->papeisUsuario);
    }

    public function novaSenha($idUsuario)
    {
        dd('ENVIAR NOVA SENHA POR E-MAIL');
    }
}
