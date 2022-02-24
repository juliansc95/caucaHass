<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">
                        Tecnico Comercial
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
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>