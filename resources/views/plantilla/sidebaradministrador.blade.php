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
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Asociados</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Detalle Productores</a>
                            </li>
                        </ul>
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
                            <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Proyeccion</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i>Compras y Ventas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=14" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i>Ventas</a>
                            </li>
                        </ul>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i>Carga Ventas</a>
                            </li>
                        </ul>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=15" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i>Compras</a>
                            </li>
                        </ul>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=13" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i>Carga Compras</a>
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
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Aplicacion Fertilizantes</a>
                            </li>
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Aplicacion productos quimicos</a>
                            </li>
                            <li @click="menu=11" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Productos Quimicos</a>
                            </li>
                            <li @click="menu=12" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i>Fertilizantes</a>
                            </li>
                        </ul>
                    </li>
                   
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>