<?php

require_once("connections/connection.php");

if (isset($_SESSION["nickname"])) {
    $nickname = $_SESSION["nickname"];
}
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nickname ?><span>

                        <?php
                        // Create a new DB connection
                        $link3 = new_db_connection();

                        /* create a prepared statement */
                        $stmt3 = mysqli_stmt_init($link3);


                        $query3 = "SELECT img_perfil
                              FROM utilizadores
                              WHERE nickname LIKE ?";

                        if (mysqli_stmt_prepare($stmt3, $query3)) {
                        mysqli_stmt_bind_param($stmt3, 's', $nickname);
                        mysqli_stmt_execute($stmt3);
                        mysqli_stmt_bind_result($stmt3,   $img_perfil);
                        while (mysqli_stmt_fetch($stmt3)) {
                        //var_dump($img_perfil);
                        if (isset($img_perfil)){
                        ?>

                        <img class="ml-3 img-profile rounded-circle" src="uploads/img_perfil/<?=$img_perfil?>">

                            <?php
                            }else{
                            ?>
                            <img class="ml-3 img-profile rounded-circle" src="../public/img/default.gif">
                                <?php
                                }
                                }
                                }
                                ?>

                </a>
                <!-- Dropdown - User Information-->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#feedmodal">
                        <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                        Website
                    </a>

                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Sair
                    </a>
                </div>
            </li>

      </ul>

  </nav>
  <!-- End of Topbar -->
<!-- Feed Modal-->
<div class="modal fade" id="feedmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso:</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tens a certeza que queres voltar para o feed?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
                <a class="btn btn-primary" href="../public/index.php">Sim</a>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso:</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tens a certeza que queres sair?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
                <a class="btn btn-primary" href="scripts/logout.php">Sim</a>
            </div>
        </div>
    </div>
</div>