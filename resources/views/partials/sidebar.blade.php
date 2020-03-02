@inject('request', 'Illuminate\Http\Request')

<div class="app-sidebar sidebar-shadow" >

  
    <div class="app-header__logo">

        <!-- PARA QUE SIRVE :  A LA HORA DE REDUCIR EL TAMAÑO NO APARECE LAS RAYITAS PARA EL MENU-->
       <img src="{{url('/img/imageescuela.png')}}" width="100px" height="100px" >

        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
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

    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">

                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ url('/home') }}" class="{{ $request->segment(1) == 'home' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Inicio
                    </a>
                </li>
                
                <!-- Admin -->


                
                @if(auth()->user()->isAdmin)
                <li class="app-sidebar__heading">Mantenimiento</li>

                <li>

                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Gestión de Usuarios
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>
                        <li class="{{ $request->segment(2) == 'administrators' ? 'mm-active' : '' }}">
                            <a href="{{ url('/admin/administrators') }}">
                                <i class="metismenu-icon"></i>
                                Administradores
                            </a>
                        </li>

                    <!-- <li class="{{ $request->segment(2) == 'teachers' ? 'mm-active' : '' }}">
                            <a href="{{ url('/admin/teachers') }}">
                                <i class="metismenu-icon"></i>
                                Profesores
                            </a>
                        </li>   -->

                        <li class="{{ $request->segment(2) == 'students' ? 'mm-active' : '' }}">
                            <a href="{{ url('/admin/students') }}">
                                <i class="metismenu-icon"></i>
                                Usuarios
                            </a>
                        </li>

                    </ul>
                </li>

               

                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Contenido
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>

    
    
                     <!-- PARA QUE SIRVE : SEGMEN-SIG-  ESTO SIRVE PARA QUE CUANDO ACTIVES EL MENU NO SE DESAPAREZCA
                                                        EL DESPLEGABLE HACER PRUEBA SACANDO LA S DE LESSONS  -->
    
                     <li class="{{ $request->segment(2) == 'lessons' ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.lessons.index') }}">
                                <i class="metismenu-icon"></i>
                                Capacitaciones
                            </a>
                        </li>
                        <!--
                        <li class="{{ $request->segment(2) == 'courses' ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.courses.index') }}">
                                <i class="metismenu-icon"></i>
                                Cursos
                            </a>
                        </li>
                        <li class="{{ $request->segment(2) == 'books' ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.books.index') }}">
                                <i class="metismenu-icon"></i>
                                Libros
                            </a>
                        </li>-->

                    </ul>
                </li>



             <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        asignaciones
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>

    
    
                     <!-- PARA QUE SIRVE : SEGMEN-SIG-  ESTO SIRVE PARA QUE CUANDO ACTIVES EL MENU NO SE DESAPAREZCA
                                                        EL DESPLEGABLE HACER PRUEBA SACANDO LA S DE LESSONS  -->
    
                     <li class="{{ $request->segment(2) == 'asignacion' ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.asignacion.index') }}">
                                <i class="metismenu-icon"></i>
                                Examenes
                            </a>
                     </li>
                        

                    </ul>
                </li>


                <!-- <li  >
                    <a href="#">
                        <i class="metismenu-icon pe-7s-server"></i>
                        Banco de Preguntas
                    </a>
                </li>-->

            <li class="app-sidebar__heading">Estadísticas</li>
            <li>
                 <a href="#">
                        <i class="metismenu-icon pe-7s-graph3"></i>
                        Reporte de Criterios
                 </a>
            

               <!-- PARA QUE SIRVE :  GENERAL -->
                <ul>   
                    <li class="{{ $request->segment(2) == 'reportes' ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.reportes.index') }}">
                                <i class="metismenu-icon"></i>
                                General Modulos
                            </a>
                     </li>
                  </ul>

        


                      <!-- PARA QUE SIRVE : POR PERSONA-->
                     <ul>
                        <li class="{{ $request->segment(2) == 'persona' ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.persona.index') }}">
                                <i class="metismenu-icon"></i>
                                Persona
                            </a>
                        </li>
                    </ul> 


                </li>

                @endif
                



                <!-- Teacher -->
                
               <!--@if(auth()->user()->isTeacher)
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-display1"></i>
                        Actividad
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li class="{{ $request->segment(2) == 'classrooms' ? 'mm-active' : '' }}">
                            <a href="{{ route('teacher.classrooms.index') }}">
                                <i class="metismenu-icon"></i>
                                Aulas
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Contenido
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li class="{{ $request->segment(2) == 'lessons' ? 'mm-active' : '' }}">
                            <a href="{{ route('home') }}">
                                <i class="metismenu-icon"></i>
                                Clases
                            </a>
                        </li>
                        <li class="{{ $request->segment(2) == 'courses' ? 'mm-active' : '' }}">
                            <a href="{{ route('home') }}">
                                <i class="metismenu-icon"></i>
                                Cursos
                            </a>
                        </li>
                        <li class="{{ $request->segment(2) == 'books' ? 'mm-active' : '' }}">
                            <a href="{{ route('home') }}">
                                <i class="metismenu-icon"></i>
                                Libros
                            </a>
                        </li>
                    </ul>
                </li>
                @endif  -->
                
                


                @if(auth()->user()->isStudent)

            <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-display1"></i>
                        Contenido
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        
                        
                        <!-- PARA QUE SIRVE :  EL 1 SIGNIFICA EL PARAMETRO NUM 1 DE LA URL DEBE SER IGUAL A A MODULOS -->
                        <li class="{{ $request->segment(2) == 'modulos' ? 'mm-active' : '' }}">
                            <a href="{{ route('student.modulos') }}">
                                <i class="metismenu-icon"></i>
                                Modulos
                            </a>
                        </li>


                    </ul>
                </li>
                
                     @endif



            </ul>
        </div>
    </div>


</div>