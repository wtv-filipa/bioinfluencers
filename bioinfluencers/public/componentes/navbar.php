<?php
if (isset($_SESSION["nickname"]) && isset($_SESSION["tipo"])) {
    $nickname = $_SESSION["nickname"];
    $tipo = $_SESSION["tipo"];
}
?>

    <header class="top ">

    <nav class="nav__ navfont container">


        <div class="nav__controls--left">

            <div class="nav__avatar"><img src="img/menu.png" alt="" class="icones nav__link--icon"/>
                    <div class="nav__menu--dropdown"><a href=""></a>
                        <li class="nav__item nav__item--active"><a class="nav__link mr-2" href="index.php"><img src="img/feed.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Feed</span></a>
                        <li class="nav__item"><a class="nav__link mr-2" href="eventos.php"><img src="img/eventos_icon.png" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text">Eventos</span></a></li>
                        <li class="nav__item"><a class="nav__link mr-2" href="top.php"><img src="img/top.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Top</span></a></li>
                        <li class="nav__item"><a class="nav__link mr-2" href="noticias.php"><img src="img/noticias.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Notícias</span></a></li>
                        <li class="nav__item"><a class="nav__link mr-2" href="grupos.php"><img src="img/grupos.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Grupos</span></a></li>
                        <li class="nav__item"><a class="nav__link mr-2" href="codigo_evento.php"><img src="img/med_trof.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Inserir código</span></a></li>
                        </li>
                    </div></i>
            </div>
        </div>


        <div class="nav__brand"><a class="nav__link" href="/"><img src="img/logo_n.png" class="" style="width:150px"></a></div>
        <div class="nav__controls nav__controls--right">
            <div class="nav__search">
                <input class="nav__search--input text-center" placeholder="Pesquisar..." type="text"/><a class="nav__search--icon " href="#"><i class="fa fa-bell-o" style="font-size: 21px"></i></a>
            </div>

            <div class="nav__avatar"><img src="img/pessoa2.jpg" class="nav__avatar--image" style="width:35px">



                    <div class="nav__avatar--dropdown"><a href="/login"></a>
                        <?php
                        if(isset($tipo) && $tipo == 1) {
                            ?>
                            <a href="../admin/index.php"><button class="nav__btn2" style="background: #7FC53C;"><i class="fa fa-shield"></i> ADMIN</button></a>
                            <?php
                        }

                        require_once("connections/connection.php");
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);
                        $query = "SELECT id_utilizadores, nickname
                              FROM utilizadores";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id,  $nickname);
                        }




                        ?>
                        <a href="perfil.php?user=<?=$nickname?>"><button class="nav__btn2"> <!--<i class="fa fa-user mr-2">--> Ver perfil</button></a>
                        <a href="codigo_utilizador.php"><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Código</button></a>
                        <a href="definicoes.php"><button class="nav__btn2"> <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button></a>
                        <a href="scripts/logout.php"><button class="nav__btn2"><i class="fa fa-sign-out mr-2"></i>Logout</button></a>

                    </div>
            </div>
            <span class="" style="font-size: 13px; color: black"><?=$nickname?></span>
        </div>

    </nav>

</header>




