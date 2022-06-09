<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/css/adminlte.css')}}">
    @livewireStyles

</head>
<body class="sidebar-mini vsc-initialized" style="height: auto;">


    @livewire('sidebar')
    

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('vendor/adminlte/js/adminlte.js')}}"></script>
    @livewireScripts

</body>
</html>