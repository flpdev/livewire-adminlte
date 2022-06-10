@section('page-title', 'Permissões')
@section('title', 'Permissões')

<div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card card-default">
        <div class="card-body">
            <div class="pb-3 float-left">
                <button wire:click="create()" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Cadastrar Nova <b>Permissão</b>
                </button>
            </div>
            <div class="float-right">
                <input wire:model="pesquisar" type="text" name="pesquisar" id="pesquisar" class="form-control"
                    placeholder="Pesquisar Nome">
            </div>
            <table class="table table-hover" id="tabela">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($permissoes) > 0)

                    @foreach ($permissoes as $key => $permissao)
                    <tr>
                        <td>{{$key+=1}}</td>
                        <td>{{$permissao->name}}</td>
                        <td>{{$permissao->description}}</td>
                        <td>
                            <button wire:click="show({{$permissao->id}})" class="btn btn-sm btn-primary">
                                <i class="fas fa-list"></i>
                                Papeis
                            </button>
                            <button wire:click="edit({{$permissao->id}})" class="btn btn-sm btn-warning">
                                <i class="fas fa-pen"></i>
                                Editar
                            </button>
                            <button wire:click="delete({{$permissao->id}})" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                                Excluir
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr>
                        <td colspan="4" class="text-center">
                            Nenhum registro encontrado.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="pt-3 float-right">
                {{ $permissoes->links() }}
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" class="modal fade show"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionModalLabel">{{$tituloModal}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$actionForm}}">
                        <div class="form-group">
                            <label for="name" class="control-label">Nome</label>
                            <input wire:model="idPermissao" type="hidden" name="idPermissao" id="idPermissao">
                            <input wire:model="name" type="text" name="name" id="name" class="form-control">
                            @error('name')
                            <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Descrição</label>
                            <input wire:model="description" type="text" name="description" id="description"
                                class="form-control">
                            @error('description')
                            <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Papeis -->
    <div wire:ignore.self id="papeisModal" tabindex="-1" aria-labelledby="papeisModalLabel" class="modal fade show"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="papeisModalLabel">{{$tituloModal}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @foreach($papeisPermissoes as $papel)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-bottom">
                            {{$papel->name}}
                            <div class="float-right">
                                <button wire:click="removePapel({{$papel->id}})" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-list"></i>
                                    Acessar Papel
                                </button>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        window.addEventListener('showModal', event => {
            $('#actionModal').modal('show');
        });
        window.addEventListener('hideModal', event => {
            $('#actionModal').modal('hide');
        });
        window.addEventListener('showPapeisModal', event => {
            $('#papeisModal').modal('show');
        });

    </script>


</div>