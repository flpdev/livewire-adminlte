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
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
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
                            Cadastrar Nova <b>Página</b>
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
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Rota Name</th>
                            <th scope="col" class="text-center">Ícone</th>
                            <th scope="col">Permissão</th>
                            <th scope="col" class="text-center" style="width: 25%;">Ação</th>
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
                            <td class="text-center">
                                <i class="{{$pagina->icon}}"></i>
                            </td>
                            <td>{{$pagina->permissao}}</td>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col">
                                            <button wire:click="edit({{$pagina->id}})"
                                                class="btn btn-sm btn-warning col">
                                                <i class="fas fa-pen"></i>
                                                Editar
                                            </button>
                                        </div>
                                        <div class="col">
                                            <button wire:click="delete({{$pagina->id}})"
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
                {{ $paginas->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" class="modal fade show"
        aria-modal="true">
        <div class="modal-dialog modal-lg"">
            <div class=" modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">{{$tituloModal}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="{{$actionForm}}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="titulo" class="control-label">Título</label>
                                <input wire:model="titulo" type="text" name="titulo" id="titulo" class="form-control"
                                    maxlength="15">
                                @error('titulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="paginaSuperiorId" class="control-label">Menu Superior</label>
                                <select wire:model="paginaSuperiorId" type="text" name="page_superior_id" id="page_superior_id" class="form-select">
                                        <option value="0" selected>Menu Principal</option>
                                        @foreach($paginas as $pagina)
                                            @if(empty($pagina->page_superior_id))
                                                @if($pagina->id != $idPagina)
                                                    <option value="{{$pagina->id}}">{{$pagina->titulo}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                </select>
                                @error('paginaSuperiorId')
                                <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descricao" class="control-label">Descrição</label>
                        <input wire:model="descricao" type="text" name="descricao" id="descricao" class="form-control">
                        @error('descricao')
                        <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="permissao" class="control-label">Permissão</label>
                                <input wire:model="permissao" type="text" name="permissao" id="permissao"
                                    class="form-control">
                                @error('permissao')
                                <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="situacao" class="control-label">Situação</label>
                                <select wire:model="situacao" type="text" name="situacao" id="situacao"
                                    class="form-select">
                                    <option value="" selected disabled>Selecione</option>
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                                @error('situacao')
                                <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="rota" class="control-label">Rota Name</label>
                                <input wire:model="rota" type="text" name="rota" id="rota" class="form-control">
                                @error('rota')
                                <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="icon" class="control-label">Ícone</label>
                                <input wire:model="icon" type="text" name="icon" id="icon" class="form-control">
                                <span class="text-primary" style="font-size: 11.5px;">
                                    <a href="https://fontawesome.com/v5/search?m=free" target="_blank"
                                        rel="noopener noreferrer">
                                        <i class="fas fa-external-link-alt"></i>
                                        Font Awesome
                                    </a>
                                </span>
                                @error('icon')
                                <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
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