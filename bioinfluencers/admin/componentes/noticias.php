<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Notícias</h1>
    <p class="mb-4">Aqui é possível fazer update das notícias e verificar quais já se encontram publicadas, podendo ser atualizadas se necessário.</p>
    <div class="row">
        <div class="col-xl-12">
            <form>
                <div class="row">
                <!--upload de imagem de capa da notícia-->
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img1">Imagem principal</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img1" class="file-upload" />
                    </div>
                </div>


                <!--colocar título da notícia-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" formmethod="post" placeholder="Indique o título">
                </div>

                <!--colocar subtítulo da notícia-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="subtitulo">Subtítulo</label>
                    <input type="text" class="form-control" id="subtitulo" placeholder="Indique o subtítulo">
                </div>

                <!--colocar corpo da notícia-->
                <div class="form-group col-12">
                    <label class="text-gray-800" for="corpo">Corpo da notícia</label>
                    <textarea type="text" class="form-control" id="corpo" placeholder="Insira o texto relativo à notícia"></textarea>
                </div>

                <!--upload de imagem adicional-->
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img2">Imagem adicional</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img2" class="file-upload" />
                    </div>
                </div>

                <!--upload de imagem adicional-->
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img2">Imagem adicional</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img2" class="file-upload" />
                    </div>
                </div>

                <div class="form-group col-3">
                    <button class="buttonCustomise"> Criar </button>
                </div>
                </div>
            </form>
        </div>
    </div>


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
                        <th>Corpo da notícia</th>
                        <th>Imagem princial</th>
                        <th>Imagens secundárias</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Título</th>
                        <th>Subtitulo</th>
                        <th>Corpo da notícia</th>
                        <th>Imagem princial</th>
                        <th>Imagens secundárias</th>
                        <th>Ações</th>
                    </tr>
                    </tfoot>

                    <?php

                    require_once "connections/connection.php";

                    $link= new_db_connection(); //Create a new DB connection
                    $stmt = mysqli_stmt_init($link); //create a prepared statement

                    $query = "SELECT id_users, email, username, date_creation, active, roles_descricao FROM users INNER JOIN roles ON users.ref_id_roles= roles.id_roles WHERE username LIKE ? OR email LIKE ? "; // Define the query


                    ?>


                    <tbody>
                    <tr>
                        <td>100 pessoas ajudaram na recolha de beatas na UA</td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. </td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris</td>
                        <td>IMG_03.jpg</td>
                        <td>IMG_03.jpg</td>
                        <td>
                            <i class="fas fa-trash"></i>
                            <i class="fas fa-ban"></i>
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>Plantar àrvores é a nova atividade do jovens</td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. </td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris</td>
                        <td>IMG_03.jpg</td>
                        <td>IMG_03.jpg</td>
                        <td>
                            <i class="fas fa-trash"></i>
                            <i class="fas fa-ban"></i>
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>UA dinamiza a adoção de uma àrvore</td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. </td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris</td>
                        <td>IMG_03.jpg</td>
                        <td>IMG_03.jpg</td>
                        <td>
                            <i class="fas fa-trash"></i>
                            <i class="fas fa-ban"></i>
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>Mais de 5000 beatas foram apanhadas em 30 minutos</td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. </td>
                        <td>Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris</td>
                        <td>IMG_03.jpg</td>
                        <td>IMG_03.jpg</td>
                        <td>
                            <i class="fas fa-trash"></i>
                            <i class="fas fa-ban"></i>
                            <i class="fas fa-edit"></i></td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>