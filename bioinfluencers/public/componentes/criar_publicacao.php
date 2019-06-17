<body class="body_criar_publicacao">
<div class="row no-gutters"><h3 class="mx-auto mt-5">

        <i class="fa fa-pencil-square-o  mr-2" aria-hidden="true"></i>
        Criar uma nova publicação</h3>

</div>

<div class="events w-75 mx-auto">


    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <form class="md-form inserir_dados" class="mb-3" action="" method="post">

            <!--<div class="file-field">
                <a class="btn-floating peach-gradient mt-0 float-left">
                    <i class="fas fa-paperclip" aria-hidden="true"></i>
                    <input type="file">
                </a>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload your file">
                </div>
            </div>-->
            <nav class="navbar navbar-expand-lg upload_docs">
                <a class="navbar-brand text" href="#"><i class="fa fa-image"></i> Carrega uma imagem</a>
            </nav>

            <br>
            <span>ou</span>

            <nav class="navbar navbar-expand-lg inserir_dados upload_docs" >
                <a class="navbar-brand" href="#"><i class="fa fa-file-video-o"></i> Carrega um vídeo</a>
            </nav>
        </form>


        <form class="md-form inserir_dados">
            <div class="form-group text-left">
                <label for="comment">O que queres publicar?</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
            </div>
        </form>

        <div>
            <button type="button" class="btn btn-success publicar_btn">PUBLICAR</button>
        </div>
    </div>
</div>

    <!--/.Card-->
</body>
