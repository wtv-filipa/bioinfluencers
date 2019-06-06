<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Criar uma notícia</h1>
    <p class="mb-4">Aqui é possível criar novas notícias.</p>
    <div class="row">
        <div class="col-xl-12">


            <!--FORM-->

            <form method="post" action="scripts/inserir_noticias.php">
                <div class="row">
                <!--upload de imagem de capa da notícia
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img1">Imagem principal</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img1" class="file-upload" />
                    </div>
                </div>
-->

                <!--colocar título da notícia-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" placeholder="Indique o título" name="titulo">
                </div>

                <!--colocar subtítulo da notícia-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="subtitulo">Subtítulo</label>
                    <input type="text" class="form-control" id="subtitulo" placeholder="Indique o subtítulo" name="subtitulo">
                </div>

                <!--colocar corpo da notícia-->
                <div class="form-group col-12">
                    <label class="text-gray-800" for="corpo">Corpo da notícia</label>
                    <textarea type="text" class="form-control" id="corpo" placeholder="Insira o texto relativo à notícia" name="texto"></textarea>
                </div>

                <!--upload de imagem adicional
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img2">Imagem adicional</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img2" class="file-upload" />
                    </div>
                </div>

                <!--upload de imagem adicional
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img2">Imagem adicional</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img2" class="file-upload" />
                    </div>
                </div>
-->


                <div class="form-group col-3">
                    <button class="buttonCustomise"> Criar </button>
                </div>
                </div>
            </form>
        </div>
    </div>





</div>