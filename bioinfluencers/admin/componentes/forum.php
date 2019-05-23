<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Fórum</h1>
    <p class="mb-4">Aqui é possível ter uma vista geral de todos os fóruns que existem, bem como as categorias disponíveis e todos os comentários publicados. O administrador pode adicionar novos fóruns, categorias e apagar comentários.</p>

    <div class="row">
        <div class="col-xl-12">
            <form>

                <div class="row">

                <!--colocar nome do forum-->
                <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Indique o nome do fórum">
                </div>

                <!--colocar categoria do fórum-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="cat">Categoria</label>
                    <select class="form-control" id="cat">
                        <option>beatas</option>
                        <option>poluição</option>
                        <option>reciclagem</option>
                        <option>florestas</option>
                    </select>
                </div>

                <!--colocar descrição do forum-->
                    <div class="form-group col-12">
                        <label class="text-gray-800" for="des">Descrição</label>
                        <textarea type="text" class="form-control" id="des" placeholder="Insira o texto relativo ao fórum"></textarea>
                    </div>

                    <div class="form-group col-3">
                        <button class="buttonCustomise"> Criar </button

            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary textCustom">Fóruns</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Descrição</th>
                        <th>Comentários</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Descrição</th>
                        <th>Comentários</th>
                        <th>Ação</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>Fim do plástico?</td>
                        <td>Plástico <br> natureza</td>
                        <td>Ativo</td>
                        <td>qual é a tua opinião sobre as novas medidas do uso do plástico?</td>
                        <td> <a href="comentarios.php">ver comentários</a></td>
                        <td>
                            <i class="fas fa-trash"></i>
                            <i class="fas fa-ban"></i>
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>Desflorestação</td>
                        <td>florestas <br> desflorestação <br> natureza</td>
                        <td>Ativo</td>
                        <td>Quais a medidas para combater a desflorestação?</td>
                        <td> <a href="comentarios.php">ver comentários</a></td>
                        <td>
                            <i class="fas fa-trash"></i>
                            <i class="fas fa-ban"></i>
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>Como resolver o problema das beatas?</td>
                        <td>poluição <br> beatas</td>
                        <td>Ativo</td>
                        <td>Será um problema fácil de se resolver?</td>
                        <td> <a href="comentarios.php">ver comentários</a></td>
                        <td>
                            <i class="fas fa-trash"></i>
                            <i class="fas fa-ban"></i>
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>Reciclagem é uma solução viável?</td>
                        <td>reciclar </td>
                        <td>Ativo</td>
                        <td>Reciclar ou não reciclar?</td>
                        <td> <a href="comentarios.php">ver comentários</a></td>
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
<!-- /.container-fluid -->


