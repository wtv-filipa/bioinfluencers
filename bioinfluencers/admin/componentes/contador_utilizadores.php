<?php
require_once("connections/connection.php");

$link = new_db_connection();
$link2 = new_db_connection();
$link3 = new_db_connection();

$stmt = mysqli_stmt_init($link);
$stmt2 = mysqli_stmt_init($link2);
$stmt3 = mysqli_stmt_init($link3);

$query = "SELECT COUNT(id_utilizadores)
          FROM utilizadores";

$query2 = "SELECT COUNT(id_utilizadores)
          FROM utilizadores 
          WHERE tipos_id_tipos = 2";

$query3 = "SELECT COUNT(id_utilizadores)
          FROM utilizadores 
          WHERE tipos_id_tipos = 3";


if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id);

    while (mysqli_stmt_fetch($stmt)) {
        ?>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                Utilizadores
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: <?= $id ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    if (mysqli_stmt_prepare($stmt2, $query2)) {

        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2, $id2);

        while (mysqli_stmt_fetch($stmt2)) {

            ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Normais
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: <?= $id2 ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        if (mysqli_stmt_prepare($stmt3, $query3)) {

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $id3);

            while (mysqli_stmt_fetch($stmt3)) {
                ?>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                        Organizadores
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: <?= $id3 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

            }
        }

    }
}
?>

