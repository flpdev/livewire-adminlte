@section('page-title', 'Papéis')
@section('title', 'Papéis')

<div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="container-fluid mb-1">
                <div class="row">
                    <div class="col-md m-1">
                        <button wire:click="create()" class="btn btn-primary float-left col-sm-12 col-md-6">
                            <i class="fas fa-plus"></i>
                            Cadastrar Novo <b>Papel</b>
                        </button>
                    </div>
                    <div class="col-md m-1">
                        <input wire:model="pesquisar" type="text" name="pesquisar" id="pesquisar"
                            class="form-control col-md-6 float-right" placeholder="Pesquisar Nome">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="tabela">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col" class="text-center" style="width: 25%;">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($papeis) > 0)

                        @foreach ($papeis as $key => $papel)
                        <tr>
                            <td>{{$key+=1}}</td>
                            <td>{{$papel->name}}</td>
                            <td>{{$papel->description}}</td>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col">
                                            <button wire:click="permissions({{$papel->id}})"
                                                class="btn btn-sm btn-primary col">
                                                <i class="fas fa-key"></i>
                                                Permissões
                                            </button>
                                        </div>
                                        <div class="col">
                                            <button wire:click="edit({{$papel->id}})"
                                                class="btn btn-sm btn-warning col">
                                                <i class="fas fa-pen"></i>
                                                Editar
                                            </button>
                                        </div>
                                        <div class="col">
                                            <button wire:click="delete({{$papel->id}})"
                                                class="btn btn-sm btn-danger col">
                                                <i class="fas fa-trash"></i>
                                                Excluir
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
            </div>


            <div class="pt-3 float-right">
                {{ $papeis->links() }}
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
                            <input wire:model="idPapel" type="hidden" name="idPapel" id="idPapel">
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

    <script>

        window.addEventListener('showModal', event => {
            $('#actionModal').modal('show');
        });
        window.addEventListener('hideModal', event => {
            $('#actionModal').modal('hide');
        });

    </script>


</div>