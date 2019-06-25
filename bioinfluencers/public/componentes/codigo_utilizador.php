<header >
    <div class="container">

        <div class="text-center">
            <img width="150px" height="250px" class="img-fluid mt-5" src="img/codigo_user.png" alt="medalha">
        </div>

        <div class="text-center">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-xs-10 mx-auto mb-5">
                <h2 class="semibold preto mb-5 mt-5">O meu código</h2>
                <?php
                require_once("connections/connection.php");

                if (isset($_SESSION["id_utilizadores"])) {
                $id_uti = $_SESSION["id_utilizadores"];

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $query = "SELECT id_utilizadores, codigo_utilizador
                          FROM utilizadores";
                if (mysqli_stmt_prepare($stmt, $query)) {


                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_uti, $codigo);
                mysqli_stmt_fetch($stmt)

                ?>
                <h5 style="height: 45px" class="personalizar"><?= $codigo ?></h5>
            </div>
            <!--<input style="height: 45px" class="text-center personalizar" type="text" placeholder="código" size="50">-->


            <div class="row">
                <!-----------colocar aqui os icons--->
            </div>
        </div>

        <div class="text-center pb-5 mt-3">
            <p class="pt-5">O teu código já foi usado <b>37</b> vezes!</p>
            <p class="p-0">Partilha-o com os teus amigos para ganhares mais pontos!</p>
        </div>
    </div>

</header>
<?php
}
}