<?php
if (isset($_SESSION["nickname"]) && isset($_SESSION["tipo"])) {
    $nickname = $_SESSION["nickname"];
    $tipo = $_SESSION["tipo"];
}
?>
<nav class="navbar navbar-default navbar-expand-xl navbar-light sticky-top">
    <div class="container">
    <div class="navbar-header d-flex col">
        <a class="navbar-brand" href="#"><img src="img/logo_n.png" class=""></a>

        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <ul class="nav navbar-nav">
            <li class="nav-item active"><a href="#" class="nav-link"><i class="fa fa-picture-o" style="font-size: 1.3rem"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-calendar-o" style="font-size: 1.3rem"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-sitemap" style="font-size: 1.3rem"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-newspaper-o" style="font-size: 1.3rem"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-star-o" style="font-size: 1.3rem"></i></a></li>

        </ul>
        <form class="navbar-form form-inline">
            <div class="input-group search-box w-50">
                <input type="text" id="search" class="form-control text-left" placeholder="Pesquisar...">
                <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
            </div>
        </form>
        <ul class="nav navbar-nav navbar-right ml-auto">
            <li class="nav-item"><a href="#" class="nav-link notifications"><i class="fa fa-bell-o"></i><span class="badge">1</span></a></li>
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img src="img/Michelle_3188.jpg" class="avatar" alt="Avatar"><?= $nickname ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                    if(isset($tipo) && $tipo == 1) {
                        ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../admin/">Admin</a></li>
                        <li><a href="../admin/index.php" class="dropdown-item" style="font-weight: bold"><i class="fa fa-shield"></i>ADMIN</a></li>
                        <?php
                    }
                    ?>

                    <li class="divider dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item"><i class="fa fa-user-o"></i>Ver perfil</a></li>
                    <li><a href="#" class="dropdown-item"><i class="fa fa-star-o"></i> Código</a></li>
                    <li><a href="#" class="dropdown-item"><i class="fa fa-sliders"></i>Definições</a></li>
                    <li class="divider dropdown-divider"></li>
                    <li><a href="scripts/logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
</nav>