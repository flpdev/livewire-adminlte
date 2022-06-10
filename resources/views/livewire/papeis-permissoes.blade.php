@section('page-title', 'Papel Permissões')
@section('title', 'Papel Permissões')

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
            <div class="row">
                <div class="col-md-6">
                    <h4 class="floa-left">{{ $papel->name }}</h4>
                </div>
                @foreach($permissoesHabilitadas as $key => $row)
                @endforeach
                <div class="col-md-6">
                    <div class="float-right position-relative">
                        <input wire:model="pesquisar" type="text" name="pesquisar" id="pesquisar" class="form-control"
                            placeholder="Pesquisar Nome">
                    </div>
                </div>


            </div>
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Habilitado</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissoes as $permissao)
                    <tr>
                        <td scope="row" class="text-center">
                            <div class="form-check form-switch">
                            <input wire:model="permissoesHabilitadasTela" type="checkbox" value="{{$permissao->name}}"
                                class="form-check-input" 
                                @if(in_array($permissao->name, $permissoesHabilitadasTela))
                                    checked
                                @endif
                            >
                            </div>
                        </td>
                        <td scope="row">{{$permissao->name}}</td>
                        <td scope="row">{{$permissao->description}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-3 float-right">
                {{ $permissoes->links() }}
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