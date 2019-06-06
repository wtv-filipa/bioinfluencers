<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Notícias</h1>
    <p class="mb-4">Aqui é possível fazer update das notícias e verificar quais já se encontram publicadas, podendo ser atualizadas se necessário.</p>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary textCustom">Notícias</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Subtitulo</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Título</th>
                        <th>Subtitulo</th>
                        <th>Ações</th>
                    </tr>
                    </tfoot>

                    <?php

                    require_once "connections/connection.php";

                    $link= new_db_connection(); //Create a new DB connection
                    $stmt = mysqli_stmt_init($link); //create a prepared statement

                    $query = "SELECT id_noticias, titulo, subtitulo, texto, data_hora FROM noticias"; // Define the query
                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                        mysqli_stmt_bind_result($stmt, $id, $title, $subtitle, $text, $date); // Bind results


                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<tbody>
                    <tr>
                        <td>$title</td>
                        <td>$subtitle</td>
                        <td>
                            <a data-toggle=\"modal\" data-target=\"#apagar\"> <i class=\"fas fa-trash\"></i> </a>
                            <a href='editar_noticia.php?id=$id'><i class=\"fas fa-edit\"></i></a>
                            <!-- Button trigger modal -->
                            <a data-toggle=\"modal\" data-target=\"#mymodal\">
                                <i class=\"fas fa-info-circle\"></i>
                            </a>
                            
                            </td>
                            
                            
                    </tr>

                    </tbody>";


                            echo "<!-- Modal mais info -->
    <div class=\"modal fade\" id=\"mymodal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\" style=\"background-color: #7FC53C\">
                    <h5 class=\"modal-title\" style=\"color:white\" id=\"exampleModalLongTitle\">Mais info</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <div class=\"modal-body\">
                    <h5>Título:</h5>
                    <p>$title</p>
                    <hr style=\"background-color: #7FC53C; opacity: 0.5\">
                    <h5>Subtitlo:</h5>
                    <p>$subtitle </p>
                    <hr style=\"background-color: #7FC53C; opacity: 0.5\">
                    <h5>Corpo da notícia: </h5>
                    <p>$text</p>
                    <hr style=\"background-color: #7FC53C; opacity: 0.5\">
                    <h5>Data: </h5>
                    <p> $date </p>
                    <hr style=\"background-color: #7FC53C; opacity: 0.5\">

                </div>
            </div>
        </div>
    </div>";



                            echo "<!-- Modal delete -->
    <div class=\"modal fade\" id=\"apagar\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\" style=\"background-color: #7FC53C\">
                    <h5 class=\"modal-title\" style=\"color:white\" id=\"exampleModalLongTitle\">Tem a certeza que quer apagar $title ?</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <div class=\"modal-body\">
                    
                    <a href='scripts/delete_noticias.php?id=$id'> <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        Apagar
                    </button> </a>

                </div>
            </div>
        </div>
    </div>";

                        }
                    }

                    ?>



                </table>
            </div>
        </div>
    </div>






</div>