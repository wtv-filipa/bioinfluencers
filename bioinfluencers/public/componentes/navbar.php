<?php
if (isset($_SESSION["nickname"]) && isset($_SESSION["tipo"]) && isset($_SESSION["id_utilizadores"])) {
    $nickname = $_SESSION["nickname"];
    $tipo = $_SESSION["tipo"];
    $id_uti = $_SESSION["id_utilizadores"];
}
?>

<header class="top  ">


    <nav class="nav__ container cont_l">


        <div class=" nav__controls--left">
            <a href="#"  class="nav__link"><i class="fa fa-bars" id="button" style="font-size: 25px !important;"></i></a>
        </div>

        <div class="nav__brand"><a class="nav__link" href="index.php"><img src="img/logo_n.png" class="img-responsive" style="width:150px; margin-right: 5px"></a></div>
        <div class="nav__controls nav__controls--right">
            <div class="nav__search">
                <input class="nav__search--input text-center" placeholder="Pesquisar..." type="text"/><a class="nav__search--icon " href="#"><i class="fa fa-bell-o" style="font-size: 21px"></i></a>
            </div>

            <div class="nav__avatar"><img src="img/pessoa2.jpg" class="nav__avatar--image " style="max-width:35px"> <span class="nome ml-3" style="color: black"><?=$nickname?></span>

                <div class="nav__avatar--dropdown"><a href="/login"></a>

                    <a href="perfil.php?user=<?=$nickname?>"><button class="nome_l nav__btn2" style="color: black"> @<?=$nickname?>  </button></a>

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
                    <a href="perfil.php?user=<?=$nickname?>"><button class="nav__btn2 nome"> <!--<i class="fa fa-star-o mr-2"></i>-->Ver Perfil</button></a>
                    <a href="codigo_utilizador.php"><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Código</button></a>
                    <a href="definicoes.php"><button class="nav__btn2"> <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button></a>




                    <a href="scripts/logout.php"><button class="nav__btn2 bg-warning"><i class="fa fa-sign-out mr-2"></i>Logout</button></a>

                </div>
    </nav>

    <nav class="nav__ nao_container">


        <div class=" nav__controls--left">
            <a href="#"  class="nav__link"><i class="fa fa-bars" id="button1" style="font-size: 25px !important;"></i></a>
        </div>

        <div class="nav__brand"><a class="nav__link" href="index.php"><img src="img/logo_n.png" class="img-responsive" style="width:150px; margin-right: 5px"></a></div>
        <div class="nav__controls nav__controls--right">
            <div class="nav__search">
                <input class="nav__search--input text-center" placeholder="Pesquisar..." type="text"/><a class="nav__search--icon " href="#"><i class="fa fa-bell-o" style="font-size: 21px"></i></a>
            </div>

            <div class="nav__avatar"><img src="img/pessoa2.jpg" class="nav__avatar--image " style="max-width:35px"> <span class="nome ml-3"><?=$nickname?></span>



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
                    <a href="perfil.php?user=<?=$nickname?>"><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Ver Perfil</button></a>

                    <a href="codigo_utilizador.php"><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Código</button></a>
                    <a href="definicoes.php"><button class="nav__btn2"> <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button></a>




                    <a href="scripts/logout.php"><button class="nav__btn2 bg-warning"><i class="fa fa-sign-out mr-2"></i>Logout</button></a>

                </div>
    </nav>


    <div id="slide1"><a href="#" id="button2"><i class="fa fa-times" style="color: black"></i>


        <ul class="ml-2">

            <li><a class="nav__link mr-2 mb-3" href="index.php"><img src="img/feed.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Feed</span></a></li>
            <li><a class="nav__link mr-2 mb-3" href="eventos.php"><img src="img/eventos_icon.png" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text">Eventos</span></a></li>
            <li><a class="nav__link mr-2 mb-3" href="top.php"><img src="img/top.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Top</span></a></li>
            <li><a class="nav__link mr-2 mb-3" href="noticias.php"><img src="img/noticias.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Notícias</span></a></li>
            <li><a class="nav__link mr-2 mb-3" href="grupos.php"><img src="img/grupos.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Grupos</span></a></li>
            <li><a class="nav__link mr-2 mb-3" href="codigo_evento.php"><img src="img/med_trof.png" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Inserir código</span></a></li>

        </ul>
    </div>

    <script>
        var btn = document.getElementById("button");
        var btn1 = document.getElementById("button1");
        var btn2 = document.getElementById("button2");
        function open() {
            var openThis = document.getElementById("slide1");
            openThis.style.width = "250px";
            if(openThis.style.width === "250px") {
                btn.style.visibility = "hidden";
                btn1.style.visibility = "hidden";

            }else{
                btn.style.visibility = "visible";
                btn1.style.visibility = "visible";
            }

        }
        function close() {
            var closeThis = document.getElementById("slide1");
            closeThis.style.width = "0px";
            if(closeThis.style.width === "0px") {
                btn.style.visibility = "visible";
                btn1.style.visibility = "visible";
            }else{
                btn.style.visibility = "visible";
                btn1.style.visibility = "visible";
            }
        }


        btn.addEventListener('click', open);
        btn1.addEventListener('click', open);
        btn2.addEventListener('click', close);

    </script>


</header>




