<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Head    ESTILOS --> 
    @include('partials.head')
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        
        <!-- Header  BARRA DE ARRIBA--> 
        @include('partials.header')
        
        <!-- Theme Configuration  RUEDITA-->
        
        
        <!-- @include('partials.themeconfig') -->
        
        

        <div class="app-main">
            
            <!-- Sidebar  BARRA DE LA MANO DERECHA-->
            @include('partials.sidebar')
            

            <!-- Start Main Content -->
            <div class="app-main__outer">
                

                <!-- Start Content -->
                <div class="app-main__inner">
                    
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                @yield('title')
                            </div>
                        </div>
                    </div> 
                   
                    <!-- Es un helper el cual verifica si se realizo de manera correcta -->
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <a class="close" data-dismiss="alert" href="#">×</a>{{ session('success') }}
                        </div>
                    @endif
                    
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @yield('content')

                    
                </div>
                <!-- End Content -->
                

                <!-- Footer BARRA DE ABAJO NO HAY NADA-->
                @include('partials.footer')
                
            </div>
            
            <!-- End Main Content -->
            
        </div>
    </div>
</body>
</html>
