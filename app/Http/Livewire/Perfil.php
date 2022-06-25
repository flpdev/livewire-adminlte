<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Perfil extends Component
{

    public $idUsuario, $name, $email, $password;

    public function rules(){
        return [
            'name' =>  'required|string|max:100',
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore(auth()->user()->id)],
        ];
    }

    public function mount(){
        $this->alimentaInfoUsuario();
    }

    public function render()
    {
        return view('livewire.perfil');
    }

    public function alimentaInfoUsuario(){
        $usuario = User::find(auth()->user()->id);
        $this->name = $usuario->name;
        $this->email = $usuario->email;
    }

    public function update(){
        $validado = $this->validate();
        try {
            User::find(auth()->user()->id)->update($validado);
            session()->flash('success', 'Senha alterada com sucesso!');
            $this->emit('refreshSidebar');
        } catch (\Throwable $th) {
            session()->flash('error', 'Ocorreu algum problema, contate o administrador.');
        }
    }

    public function editPassword(){
        $this->clearFields();
        $this->dispatchBrowserEvent('showModal');
    }

    public function updatePassword(){

        $senha = $this->validate(
            ['password' => ['required', Password::min(8)]],
        );

        $this->password = bcrypt($senha['password']);

        try {
            User::find(auth()->user()->id)->update(['password' => $this->password]);
        } catch (\Throwable $th) {
            session()->flash('error', 'Ocorreu algum problema, contate o administrador.');
            $this->clearFields();
        }
        
        session()->flash('success', 'Senha alterada com sucesso!');
        $this->dispatchBrowserEvent('hideModal');
        $this->clearFields();
    }

    public function clearFields(){
        $this->senha = '';
    }

}
