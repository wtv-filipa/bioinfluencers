<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Temas das notícias</h1>
    <p class="mb-4">Aqui é possível criar todas os temas das notícias.</p>

    <div class="row">
        <div class="col-xl-12">

            <form method="post" action="scripts/inserir_temas_noticias.php">

                <div class="row">

                    <!--colocar nome da categoria-->
                    <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome"
                               placeholder="Indique o nome do tema">
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="buttonCustomise"> Criar</button
                    </div>

            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
