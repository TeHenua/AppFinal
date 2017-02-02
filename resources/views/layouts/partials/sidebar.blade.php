<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"></li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ $nav_home or ''  }}"><a href="{{ url('/') }}"><i class='fa fa-home'></i> <span>Inicio</span></a></li>
            <li><a href="{{ url('calendario') }}"><i class='fa fa-calendar'></i> <span>Calendario</span></a></li>
            <li class="treeview {{ $abierto_usuario or '' }}">   
                <a href="#"><i class='fa fa-users'></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu ">
                    <li class="{{ $nav_usuario_index or '' }}">
                        <a href="{{ url('usuarios') }}"><i class="fa fa-search"></i>Buscar</a>
                    </li>
                    <li class="{{ $nav_usuario_create or '' }}">
                        <a href="{{ url('usuarios/create') }}"><i class="fa fa-user-plus"></i>Añadir nuevo</a>
                    </li>
                </ul>
            </li>           
            <li class="treeview {{ $abierto_socio or '' }}">   
                <a href="#"><i class='fa fa-users'></i> <span>Socios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu ">
                    <li class="{{ $nav_socio_index or '' }}">
                        <a href="{{ url('socios') }}"><i class="fa fa-search"></i>Buscar</a>
                    </li>
                    <li class="{{ $nav_socio_create or '' }}">
                        <a href="{{ url('socios/create') }}"><i class="fa fa-user-plus"></i>Añadir nuevo</a>
                    </li>
                </ul>
            </li>     
            <li class="treeview {{ $abierto_contacto or '' }}">   
                <a href="#"><i class='fa fa-users'></i> <span>Contactos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu ">
                    <li class="{{ $nav_contacto_index or '' }}">
                        <a href="{{ url('contactos') }}"><i class="fa fa-search"></i>Buscar</a>
                    </li>
                    <li class="{{ $nav_contacto_create or '' }}">
                        <a href="{{ url('contactos/create') }}"><i class="fa fa-user-plus"></i>Añadir nuevo</a>
                    </li>
                </ul>
            </li>   
            @if(Auth::user()->rol == 'psicologo' or Auth::user()->rol=='administrador')   
                <li class="treeview {{ $abierto_clinico or '' }}">   
                    <a href="#"><i class='fa fa-user-md'></i> <span>Psicología</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu ">
                    @if(Auth::user()->rol == 'administrador')
                        <li class="{{ $nav_clinico_index or '' }}">
                            <a href="{{ url('psicologia/index') }}"><i class="fa fa-search"></i>Buscar</a>
                        </li>
                        <li class="{{ $nav_clinico_buscar or '' }}">
                            <a href="{{ url('clinico/create') }}"><i class="fa fa-user-plus"></i>Añadir nuevo</a>
                        </li>
                        <li class="{{ $nav_clinico_buscar or '' }}">
                            <a href="{{ url('clinico/create') }}"><i class="fa fa-folder-open"></i>Añadir PIA</a>
                        </li>
                    @endif
                        <li class="{{ $nav_clinico_grupos or '' }}">
                            <a href="{{ url('psicologia/grupos') }}"><i class="fa fa-users"></i>Grupos</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
