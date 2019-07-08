<?php
if (isset($_GET['id_g'])) {

    // We need the function!
    require_once("connections/connection.php");

    $id_g = $_GET['id_g'];

    ?>


    <div class="container">
        <section class="wrapper">
            <div class="divider">
                <h1 class="">Beatas na Praia</h1>
            </div>
        </section>

        <!---------------------DEIXAR UM COMENTÁRIO------------------->
        <div class="row justify-content-center py-5">
            <div class="col-auto">

                <?php
                // Create a new DB connection
                $link = new_db_connection();


                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);


                $query = "SELECT id_utilizadores, img_perfil
                              FROM utilizadores
                              WHERE id_utilizadores LIKE ?";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id, $img_perfil);
                    while (mysqli_stmt_fetch($stmt)) {

                        ?>


                        <a href="profile.php?user=<?=$id?>">
                            <img src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                 class="avatar" alt="">
                        </a>

                        <?php
                    }
                }
                ?>

            </div>
            <div class="col-12 col-md-8">

                <div class="card mb-3 wow fadeIn">
                    <div class="card-header font-weight-bold">Deixa um comentário</div>
                    <div class="card-body">

                        <form action="scripts/inserir_comentario.php?comentario=<?= $id_g ?>" method="post"
                              id="commentform"
                              class="comment-form">

                            <!-- Comment -->
                            <div class="form-group">
                                <label for="comment">O teu comentário</label>
                                <textarea id="comment" name="comentario" type="text" class="form-control"
                                          rows="5" onkeyup="this.value = this.value.slice(0, 500)"></textarea>
                            </div>

                            <div style="align-content: end; align-items: end">
                                <button class="buttonCustomise btn btn-primary " type="submit" value="Upload Image"
                                        name="Submit">Comentar
                                </button>
                            </div>
                        </form>
                    </div><!-- #respond -->
                </div>

            </div>
        </div>


        <h2>Comentários</h2>

        <!------------------COMENTÁRIOS EXISTENTES--------------->
        <div class="row justify-content-center py-5">
            <div class="col-auto">

                <a href="#">
                    <img src="https://gravatar.com/avatar/24441e6ff463183491dbd02175758016?s=80&d=https://codepen.io/assets/avatars/user-avatar-80x80-bdcd44a3bfb9a5fd01eb8b86f9e033fa1a9897c3a15b33adfc2649a002dab1b6.png"
                         class="avatar" alt="">
                </a>

            </div>
            <div class="col-12 col-md-8">

                <div class="card">
                    <div class="card-header py-2">
                        <span>Katherine Ortega</span> replied 2 days ago
                    </div>
                    <div class="card-body">
                        <h5>A Note about Security</h5>
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident dolores hic
                            porro, quod veniam dolor corrupti tenetur nemo eius facilis ipsum modi ex, sunt omnis illum
                            et labore. Inventore, eos.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
}
?>