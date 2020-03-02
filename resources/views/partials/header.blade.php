<div class="app-header header-shadow">
   
    <div class="app-header__logo">
            
         <img class="num" src="{{url('/img/saasd.png')}}" width="220px" height="50px" >

    
         <!-- PARA QUE SIRVE : LA RAYITA PARA QUE APAREZCA EL MENU -->
        @auth

        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        @endauth

    </div>


    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>


    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>   


    <div class="app-header__content">
        
        <!--
        <div class="app-header-left">
            @auth
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Ingrese su búsqueda">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div>

            <ul class="header-menu nav">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon fa fa-chart-pie"></i>
                        Reportes
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon fa fa-edit"></i>
                        Cursos
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon fa fa-cog"></i>
                        Configuración
                    </a>
                </li>
            </ul>  
            @endauth
        </div>

          -->
            

        <div class="app-header-right">
            @auth
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        
                        <div class="widget-content-left ">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="{{ url('/img/avatars/2.jpg') }}" alt=""><div></div>
                                    <i>Configuración</i><i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <h6 tabindex="-1" class="dropdown-header">Configuración de Cuenta</h6>
                                    <a href="#" tabindex="0" class="dropdown-item">Perfil</a>
                                    <a href="#" tabindex="0" class="dropdown-item">Configuración</a>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" tabindex="0" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                            
                        <div class="widget-content-left  ml-4 header-user-info">
                            <div class="widget-heading">
                                {{ auth()->user()->fullname }}
                            </div>
                            <div class="widget-subheading">
                                {{ auth()->user()->role->title }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            @endguest
        </div>

    </div>

</div>


