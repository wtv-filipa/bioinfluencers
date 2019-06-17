<body class="body_criar_evento">
<div class="row no-gutters"><h3 class="mx-auto mt-5">

        <i class="fa fa-calendar-plus-o  mr-2" aria-hidden="true"></i>
        Criar um evento</h3>

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
        </form>

        <form class="md-form inserir_dados">
            <div class="form-group text-left">
                <label>Nome do evento:</label>
                <input class="form-control">
            </div>

            <br>

            <div class="form-group text-left">
                <label>Data:</label>
                <input class="form-control">
            </div>

            <br>

            <div class="form-group text-left">
                <label> Hora de início:</label>
                <input class="form-control">

                <br>

                <label>Hora de fim:</label>
                <input class="form-control">
            </div>

            <br>

            <div class="form-group text-left">
                <label for="comment">Local:</label>
                <input class="form-control">
            </div>

            <br>

            <div class="form-group text-left">
                <label>Descrição do evento:</label>
                <textarea class="form-control"></textarea>
            </div>

            <br>

            <div class="form-group text-left" row="2">
                <label>Preço:</label>
                <input class="form-control" placeholder="€">
            </div>
        </form>


        <div>
            <button type="button" class="btn btn-success publicar_btn">CRIAR</button>
        </div>
    </div>
</div>

<!--/.Card-->
</body>
