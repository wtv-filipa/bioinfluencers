<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Eventos</h1>
    <p class="mb-4">Adicionar novos eventos ou gerir eventos já criados</p>


    <div class="row">
        <div class="col-xl-12">
            <form method="post" action="scripts/inserir_evento.php" enctype="multipart/form-data">

                <div class="row">

                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="nome">Nome do Evento</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Indique o título">
                    </div>


                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="local">Local</label>
                        <input type="text" class="form-control" id="local" name="local" placeholder="Indique o local">
                    </div>


                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="data_inicio">Data de Início </label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio"
                               placeholder="Indique a data de início">
                    </div>


                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="data_fim">Data de Fim </label>
                        <input type="date" class="form-control" id="data_fim" name="data_fim"
                               placeholder="Indique a data de fim">
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="data_fim">Hora do Início </label>
                        <input type="time" min="00:00" max="23:59" class="form-control" id="hora_inicio"
                               name="hora_inicio" placeholder="Indique a hora do início">
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="data_fim">Hora do Fim </label>
                        <input type="time" min="00:00" max="23:59" class="form-control" id="hora_fim" name="hora_fim"
                               placeholder="Indique a hora do fim">
                    </div>

                    <div class="form-group col-12">
                        <label class="text-gray-800" for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao"
                               placeholder="Insira aqui a descrição do evento">
                    </div>


                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="responsavel">Responsável</label>
                        <input type="text" class="form-control" id="responsavel"
                               placeholder="Indique o responsável do evento" name="responsavel">
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="custos">Custos</label>
                        <input type="number" class="form-control" id="custos" placeholder="Indique os custos do evento"
                               name="custos">
                    </div>

                    <div class="col-xl-12">
                        <div class="row">
                            <div class="form-group col-xl-6 col-lg-6 col-sm-6 mt-2">
                                <!--colocar nome do forum-->

                                <label class="text-gray-800" for="nome">Seleciona uma imagem para
                                    upload:</label>

                                <div class="row">
                                    <input type="file" name="fileToUpload" class="file-upload ml-3"/>
                                </div>
                            </div>


                            <div class="form-group col-12 mt-3">
                                <button class="buttonCustomise" type="submit" value="Upload Image" name="Submit">
                                    Criar
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>