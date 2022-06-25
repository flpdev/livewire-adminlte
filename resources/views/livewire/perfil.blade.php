@section('page-title', 'Perfil')
@section('title', 'Perfil')

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
                    <div class="col-md-12">
                        <form wire:submit.prevent="update" action="">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="col-sm-2 control-label">Nome</label>
                                        <input wire:model="name" type="text" name="name" class="form-control">
                                        @error('name')
                                        <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="col-md-2 control-label">Email</label>
                                        <input wire:model="email" type="email" name="email" class="form-control">
                                        @error('email')
                                        <span class="text-danger" style="font-size: 11.5px;">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i>
                                            Gravar
                                        </button>
                                        <a  wire:click="editPassword"" class="btn btn-outline-primary">
                                            <i class="fas fa-key"></i>
                                            Alterar Senha
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" class="modal fade show"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionModalLabel">Alterar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updatePassword">
                        <div class="form-group">
                            <label for="password" class="control-label">Senha</label>
                            <input wire:model="password" type="password" name="password" id="password"
                                class="form-control">
                            @error('password')
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