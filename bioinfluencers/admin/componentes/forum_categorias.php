<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
    <p class="mb-4">Aqui é possível gerir todas as categorias do fórum.</p>

    <div class="row">
        <div class="col-xl-12">
            <form>

                <div class="row">

                    <!--colocar nome da categoria-->
                    <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="Indique o nome do fórum">
                    </div>

                    <!--colocar descrição-->
                    <div class="form-group col-12">
                        <label class="text-gray-800" for="des">Descrição</label>
                        <textarea type="text" class="form-control" id="des" placeholder="Insira o texto relativo à categoria"></textarea>
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
                        <th>Data de criação</th>
                        <th>Descrição</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Data de criação</th>
                        <th>Descrição</th>
                        <th>Ação</th
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>natureza</td>
                        <td>2019/04/30</td>
                        <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                        <td>
                            <i class="fas fa-trash"></i>
                           
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>beatas</td>
                        <td>2019/04/13</td>
                        <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                        <td>
                            <i class="fas fa-trash"></i>
                           
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>poluição</td>
                        <td>2019/03/30</td>
                        <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                        <td>
                            <i class="fas fa-trash"></i>
                           
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>florestas</td>
                        <td>2019/04/3</td>
                        <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                        <td>
                            <i class="fas fa-trash"></i>
                           
                            <i class="fas fa-edit"></i></td>
                    </tr>
                    <tr>
                        <td>plástico</td>
                        <td>2019/04/30</td>
                        <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                        <td>
                            <i class="fas fa-trash"></i>
                           
                            <i class="fas fa-edit"></i></td>
                    </tr>

                    <tr>
                        <td>reciclar</td>
                        <td>2019/04/30</td>
                        <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                        <td>
                            <i class="fas fa-trash"></i>
                           
                            <i class="fas fa-edit"></i></td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

