

    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span
                    class="logo-name">Otika</span>
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Main</li>

                <li class="dropdown <?php echo $this->router->fetch_class() == 'home' && $this->router->fetch_method() == 'index' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('restringido'); ?>" class="nav-link"><i data-feather="home"></i><span>Home</span></a>
                </li>

                <li class="dropdown <?php echo $this->router->fetch_class() == 'usuarios' && $this->router->fetch_method() == 'index' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('restringido/usuarios'); ?>" class="nav-link"><i data-feather="users"></i><span>Usuarios</span></a>
                </li>

                <li class="dropdown <?php echo $this->router->fetch_class() == 'lineas' && $this->router->fetch_method() == 'index' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('restringido/lineas'); ?>" class="nav-link"><i data-feather="layers"></i><span>Lineas</span></a>
                </li>

                <li class="dropdown <?php echo $this->router->fetch_class() == 'maestro' && $this->router->fetch_method() == 'index' ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="package"></i><span>Categorías</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?php echo base_url('restringido/maestro'); ?>">Categorías</a></li>
                    </ul>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?php echo base_url('restringido/categorias'); ?>">Sub-categorías</a></li>
                    </ul>
                </li>

                <li class="dropdown <?php echo $this->router->fetch_class() == 'productos' && $this->router->fetch_method() == 'index' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('restringido/productos'); ?>" class="nav-link"><i data-feather="archive"></i><span>Productos</span></a>
                </li>
                
                <li class="dropdown <?php echo $this->router->fetch_class() == 'sistema' && $this->router->fetch_method() == 'index' ? 'active' : ''; ?>">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="settings"></i><span>Configuración</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="<?php echo base_url('restringido/sistema'); ?>">Sistema</a></li>
                    </ul>
                </li>
            </ul>
        </aside>
    </div>