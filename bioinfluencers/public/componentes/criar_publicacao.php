<body class="body_criar_publicacao">
<div class="row no-gutters"><h3 class="mx-auto mt-5">

        <i class="fa fa-pencil-square-o  mr-2" aria-hidden="true"></i>
        Criar uma nova publicação</h3>

</div>

<div class="events w-75 mx-auto">


    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">
        <form class="md-form inserir_dados" class="mb-3" action="scripts/criar_publicacao.php" enctype=“multipart/formdata" method="post">

            <input type="file" name="upImagem" class="foo">


            <div class="mt-3 mb-3">ou</div>


            <input type="file" class="foo video">

            <div class="form-group text-left mt-4">
                <label for="comment">O que queres publicar?</label>
                <textarea class="form-control" rows="5" id="comment" name="comentar"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-success publicar_btn">PUBLICAR</button>
            </div>
        </form>
    </div>
</div>

<!--/.Card-->
</body>
