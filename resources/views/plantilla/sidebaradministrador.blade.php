<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Administrador
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Cultivo</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Fincas</a>
                            </li>
                            <li @click="menu=21" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Mapa fincas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Asociados</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Detalle Productores</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Ventas</a>
                            </li>
                            <li  @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Categorias Mora</a>
                            </li>
                            <li  @click="menu=23" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Lugares de Venta</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                            <li @click="menu=26" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Copia de seguridad</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i>Formatos Aplicacion</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Aplicacion productos quimicos </a>
                            </li>
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Aplicacion Fertilizantes</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Encuestas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=19" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Visita Extensionista</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>