<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center p-0" href="index.php">
        <!--<div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>-->
        <div class="sidebar-brand-text mx-3 mt-4">
            <img class="w-100" src="img/logo_admin.png">
        </div>
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
        <a class="nav-link" href="administradores.php">
            <i class="fas fa-user-cog"></i>
            <span>Utilizadores</span>
        </a>

    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
           aria-controls="collapsePages">
            <i class="fas fa-fw fa-cog"></i>
            <span>Páginas</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <!--parte das notícias-->
                <h6 class="collapse-header">Notícias:</h6>
                <a class="collapse-item" href="noticias.php">Notícias</a>
                <a class="collapse-item" href="criar_noticia.php"> Criar notícia</a>
                <a class="collapse-item" href="temas_noticias.php">Temas noticias</a>
                <a class="collapse-item" href="criar_tema_noticia.php"> Criar tema das noticias</a>
                <div class="dropdown-divider"></div>

                <!--parte dos eventos-->
                <h6 class="collapse-header">Eventos:</h6>
                <a class="collapse-item" href="eventos.php">Eventos</a>
                <a class="collapse-item" href="criar_evento.php"> Criar evento</a>

                <div class="dropdown-divider"></div>

                <!--parte dos foruns-->
                <h6 class="collapse-header">Grupos:</h6>
                <a class="collapse-item" href="grupos.php">Grupos</a>
                <a class="collapse-item" href="criar_grupo.php"> Criar grupos</a>
                <a class="collapse-item" href="categorias.php">Categorias dos grupos</a>
                <a class="collapse-item" href="criar_categorias.php"> Criar categoria</a>
                <div class="dropdown-divider"></div>

                <!--parte dos Categorias-->
                <h6 class="collapse-header">Conteúdos:</h6>
                <a class="collapse-item" href="conteudos.php">Conteúdos</a>
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