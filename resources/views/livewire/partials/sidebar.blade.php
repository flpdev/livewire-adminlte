<div>
    <style>
        .right{
            position: absolute;right: 1rem;top: 0.7rem;color: white;
        }
        .fa-angle-left:before {
            content: "\f104";
        }
    </style>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
            <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Pesquisar"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
                <div class="sidebar-search-results">
                    <div class="list-group"><a href="#" class="list-group-item">
                            <div class="search-title"><strong class="text-light"></strong>N<strong
                                    class="text-light"></strong>o<strong class="text-light"></strong> <strong
                                    class="text-light"></strong>e<strong class="text-light"></strong>l<strong
                                    class="text-light"></strong>e<strong class="text-light"></strong>m<strong
                                    class="text-light"></strong>e<strong class="text-light"></strong>n<strong
                                    class="text-light"></strong>t<strong class="text-light"></strong> <strong
                                    class="text-light"></strong>f<strong class="text-light"></strong>o<strong
                                    class="text-light"></strong>u<strong class="text-light"></strong>n<strong
                                    class="text-light"></strong>d<strong class="text-light"></strong>!<strong
                                    class="text-light"></strong></div>
                            <div class="search-path"></div>
                        </a></div>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @foreach($pages as $page)
                        @if($page->permissao && empty($page->page_superior_id))
                            @can($page->permissao)
                                <li class="nav-item">                             
                                    <a href="@if(!empty($sub_page->rota) || !$page->isMenuPai()) {{ route($page->rota) }} @endif" class="nav-link">
                                        <i class="{{$page->icon}}"></i>
                                        <p>{{$page->titulo}}</p>
                                        @if($page->isMenuPai())
                                            <i class="fas fa-angle-left right"></i>
                                        @endif
                                    </a>
                                    @if($page->isMenuPai())
                                        <ul class="nav nav-treeview">
                                        <!-- SUBMENU -->
                                        @foreach($pages as $sub_page)
                                            @if($sub_page->page_superior_id == $page->id)
                                                @can($sub_page->permissao)
                                                <li class="nav-item">
                                                    <a href="@if(!empty($sub_page->rota))  {{ route($sub_page->rota) }}  @endif" class="nav-link">
                                                        <i class="{{$sub_page->icon}}"></i>
                                                        <p>{{$sub_page->titulo}}</p>
                                                    </a>
                                                </li>
                                                @endcan
                                            @endif
                                        @endforeach
                                        <!-- END SUBMENU -->
                                        </ul>
                                    @endif
                                </li>
                            @endcan
                        @else
                            <li @if(empty($page->page_superior_id)) class="nav-item" @else class="nav nav-treeview" @endif>
                                <a href="@if(!empty($page->rota)) {{ route($page->rota) }} @endif" class="nav-link">
                                    <i class="{{$page->icon}}"></i>
                                    <p>{{$page->titulo}}</p>
                                    @if($page->isMenuPai())
                                        <i class="fas fa-angle-left right"></i>
                                    @endif
                                </a>
                                @if($page->isMenuPai())
                                <ul class="nav nav-treeview">
                                    <!-- SUBMENU -->
                                    @foreach($pages as $sub_page)
                                        @if($sub_page->page_superior_id == $page->id)
                                            @can($sub_page->permissao)
                                            <li class="nav-item">
                                                <a href="@if(!empty($sub_page->rota))  {{ route($sub_page->rota) }}  @endif" class="nav-link">
                                                    <i class="{{$sub_page->icon}}"></i>
                                                    <p>{{$sub_page->titulo}}</p>
                                                </a>
                                            </li>
                                            @endcan
                                        @endif
                                    @endforeach
                                    <!-- END SUBMENU -->
                                </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </aside>
</div>


