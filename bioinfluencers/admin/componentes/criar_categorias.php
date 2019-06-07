<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
    <p class="mb-4">Aqui é possível gerir todas as categorias do fórum.</p>

    <div class="row">
        <div class="col-xl-12">

            <form method="post" action="scripts/inserir_categorias.php">

                <div class="row">

                    <!--colocar nome da categoria-->
                    <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Indique o nome da categoria">
                    </div>

                    <!--colocar descrição-->
                    <div class="form-group col-12">
                        <label class="text-gray-800" for="des">Descrição</label>
                        <textarea type="text" class="form-control" id="des" name="descricao" placeholder="Insira o texto relativo à categoria"></textarea>
                    </div>

                    <div class="form-group col-3">
                        <button type="submit" class="buttonCustomise"> Criar </button

            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

