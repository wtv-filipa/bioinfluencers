<body class="body_criar_evento">
<div class="row no-gutters"><h3 class="mx-auto mt-5">

        <i class="fa fa-calendar-plus-o  mr-2" aria-hidden="true"></i>
        Criar um evento</h3>

</div>

<div class="events w-75 mx-auto">


    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <form class="md-form inserir_dados" class="mb-3" action="scripts/criar_evento.php" enctype=“multipart/formdata" method="post">

            <input type="file" name="foto" class="foo mb-5">

            <span class="md-form inserir_dados">
                <div class="form-group text-left">
                    <label>Nome do evento:</label>
                    <input type="text" name="nomeEvento" class="form-control">
                </div>

                <div class="form-group text-left mt-4">
                    <label>Data inicio:</label>
                    <input type="date" name="dataInicio" class="form-control">
                </div>

                <div class="form-group text-left mt-4">
                    <label>Data fim:</label>
                    <input type="date" name="dataFim" class="form-control">
                </div>


                <div class="form-group text-left mt-4">
                    <label> Hora de início:</label>
                    <input type="time" min="00:00" max="23:59" name="horaInicio" class="form-control">


                    <label>Hora de fim:</label>
                    <input type="time" min="00:00" max="23:59" name="horaFim" class="form-control">
                </div>


                <div class="form-group text-left mt-4">
                    <label for="comment">Local:</label>
                    <input type="text" name="local" class="form-control">
                </div>


                <div class="form-group text-left mt-4">
                    <label>Descrição do evento:</label>
                    <textarea type="text" name="descricao" class="form-control"></textarea>
                </div>


                <div class="form-group text-left mt-4" row="2">
                    <label>Preço:</label>
                    <input type="number" name="preco" class="form-control" placeholder="€">
                </div>

                <div class="form-group text-left mt-4">
                    <label>Organizador:</label>
                    <input type="text" name="organizador" class="form-control"></input>
                </div>

                <div>
                    <button type="submit" class="btn btn-success publicar_btn">CRIAR</button>
                </div>
            </span>
        </form>
    </div>
</div>

<!--/.Card-->
</body>
