<?php
require_once("connections/connection.php");

$link = new_db_connection();

$stmt = mysqli_stmt_init($link);

$query = "SELECT COUNT id_utilizadores
          FROM utilizadores";

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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total: lalalalalaa<?= $id ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2 borderCustom">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">Organizadores</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Número Total</div>
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
?>