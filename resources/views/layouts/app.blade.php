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

        {{$slot}}

        @livewire('partials.footer')


    </div>

    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
    @yield('scripts')
    @livewireScripts

</body>

</html>