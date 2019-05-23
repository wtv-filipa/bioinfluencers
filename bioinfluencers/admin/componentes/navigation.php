<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <!--<div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>-->
        <div class="sidebar-brand-text mx-3">BioInfluencers Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        GESTÃO
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
           aria-controls="collapseTwo">
            <i class="fas fa-user-cog"></i>
            <span>Utilizadores</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Editar utilizadores:</h6>
                <a class="collapse-item" href="administradores.php">Utilizadores</a>
            </div>
        </div>
    </li>

    <!--Nav Item - Utilities Collapse Menu-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Códigos</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Códigos</h6>
                <a class="collapse-item" href="codigos_users.php">Códigos dos Utilizadores</a>
                <!--
               <a class="collapse-item" href="utilities-border.php">Borders</a>
               <a class="collapse-item" href="utilities-animation.php">Animations</a>
               <a class="collapse-item" href="utilities-other.php">Other</a>
           </div>
       </div>
   </li>
   -->

                <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
           aria-controls="collapsePages">
            <i class="fas fa-fw fa-cog"></i>
            <span>Páginas</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">Páginas:</h6>

                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <p>Eventos</p>
                        <a class="collapse-item" href="eventos.php">Eventos</a>
                        <a class="collapse-item" href="eventos.php">Confirmações</a>
                    </div>
                </div>
                <a class="collapse-item" href="noticias.php">Notícias</a>
                <a class="collapse-item" href="forum.php">Fórum</a>
                <a class="collapse-item" href="categorias.php">Categorias do fórum</a>
                <a class="collapse-item" href="conteudos.php">Conteúdos</a>
                <!--<div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="../extras/404.php">404 Page</a>-->

            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->