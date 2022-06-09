<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'adminlte')</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    @yield('styles')
    @livewireStyles

</head>

<body class="sidebar-mini vsc-initialized" style="height: auto;">
    <div class="wrapper">

        @livewire('partials.navbar')
        @livewire('partials.sidebar')


        <div class="content-wrapper" style="min-height: 244.8px;">
            @section('title', 'Teste')

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page-title', 'Título Página')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('page-title', 'Título Página')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        {{$slot}}

                    </div>
                </div>
            </div>

        </div>

        @livewire('partials.footer')

    </div>

    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>    
    <script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
    @yield('scripts')
    @livewireScripts

</body>

</html>