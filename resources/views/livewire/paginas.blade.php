@section('page-title', 'Páginas')
@section('title', 'Páginas')

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
            <div class="pb-3 float-left">
                @can('papel-create')
                <button wire:click="create()" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Cadastrar Nova <b>Página</b>
                </button>
                @endcan
            </div>
            <div class="float-right">
                <input wire:model="pesquisar" type="text" name="pesquisar" id="pesquisar" class="form-control"
                    placeholder="Pesquisar Nome">
            </div>
            <table class="table table-hover" id="tabela">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Rota</th>
                        <th scope="col">Ícone</th>
                        <th scope="col">Permissão</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($paginas) > 0)

                    @foreach ($paginas as $key => $pagina)
                    <tr>
                        <td>{{$key+=1}}</td>
                        <td>{{$pagina->titulo}}</td>
                        <td>{{$pagina->descricao}}</td>
                        <td>{{$pagina->rota}}</td>
                        <td>{{$pagina->icone}}</td>
                        <td>{{$pagina->permissao}}</td>
                        <td>
                            <button wire:click="permissions({{$pagina->id}})" class="btn btn-sm btn-primary">
                                <i class="fas fa-key"></i>
                                Permissões
                            </button>
                            <button wire:click="edit({{$pagina->id}})" class="btn btn-sm btn-warning">
                                <i class="fas fa-pen"></i>
                                Editar
                            </button>
                            <button wire:click="delete({{$pagina->id}})" class="btn btn-sm btn-danger">
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
                {{ $paginas->links() }}
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
                            <input wire:model="idPagina" type="hidden" name="idPagina" id="idPagina">
                            <input wire:model="titulo" type="text" name="titulo" id="titulo" class="form-control">
                            @error('titulo')
                            <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descricao" class="control-label">Descrição</label>
                            <input wire:model="descricao" type="text" name="descricao" id="descricao"
                                class="form-control">
                            @error('descricao')
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