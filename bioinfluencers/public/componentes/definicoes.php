<!--Definições gerais-->
<div class="container ml-5" id="div_definicoes">
    <div class="row no-gutters">
        <h4 class="mt-5">
            <i class="fa fa-cogs mr-2" aria-hidden="true"></i>
            Definições
        </h4>

    </div>


    <div class="container w-75 mx-auto">
        <br>

        <h6 class="acessibilidadeh6"><a href="#">Notificações</a></h6>

        <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>

        <br> <br>

        <?php
        // We need the function!
        require_once("connections/connection.php");

        // Create a new DB connection
        $link = new_db_connection();


        /* create a prepared statement */
        $stmt = mysqli_stmt_init($link);


        $query = "SELECT id_utilizadores, nickname
                              FROM utilizadores
                              WHERE nickname LIKE ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 's', $nickname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id, $nickname);
        while (mysqli_stmt_fetch($stmt)) {
            ?>

            <h6 class="acessibilidadeh6"><a href="editar_conta.php?edit=<?= $nickname ?>">Conta</a></h6>
            <?php
        }
        }
        ?>
        <br> <br>

        <h6 class="acessibilidadeh6"><a href="#">Privacidade e segurança</a></h6>

        <br> <br>

        <h6 class="acessibilidadeh6"><a href="#">Segurança</a></h6>

    </div>

    <br> <br>

    <!--Acessibilidade-->

    <div class="row no-gutters">
        <h4 class="mt-5 acessibilidadeh4">
            <i class="fa fa-hand-paper-o mr-2" aria-hidden="true"></i>
            Acessibilidade
        </h4>

    </div>


    <div class="container w-75 mx-auto">
        <br>
        <br> <br>
        <h6 class="acessibilidadeh6">Idioma</h6>

        <br> <br>
        <h6 id="tamanhoFontetxt" class="acessibilidadeh6 mb-3">Tamanho da fonte</h6>

        <!--<span class="slidecontainer">
            <input type="range" min="1" max="100" value="50" class="sliderfonte" id="myRange" step="1" onchange="sliderChange(this.value)">

            slider value = <span id="sliderStatus">50</span>
        </span>-->
        <!--diminuir-->
        <a style="cursor: pointer; color: inherit; text-decoration: none" onClick="fonte('d'); fonteh1('d'); fonteh2('d'); fonteh3('d'); fonteh4('d'); fonteh5('d'); fonteh6('d'); fontesmall('d');">
        <button style="border-radius: 100%; width: 50px; height: 50px" type="button" class="btn btn-success operador text-center">
            -
        </button>
        </a>

        <!--aumentar-->
        <a style="cursor: pointer; color: inherit; text-decoration: none" onClick="fonte('a'); fonteh1('a'); fonteh2('d'); fonteh3('a'); fonteh4('a'); fonteh5('a'); fonteh6('a'); fontesmall('a');">
        <button style="border-radius: 100%; width: 50px; height: 50px"  type="button" class="btn btn-success operador">
           +
        </button>
        </a>
    </div>


    <!--Restantes-->
    <div class="mb-0">
        <div class="row no-gutters">
            <h6 class="mt-5 acessibilidadeh6">
                <i class=" mr-2" aria-hidden="true"></i>
                <a href="#" id="ajuda"><strong>Ajuda</strong></a>
            </h6>
        </div>

        <div class="row no-gutters">
            <h6 class="mt-3 acessibilidadeh6">
                <i class=" mr-2" aria-hidden="true"></i>
                <a href="#" id="sobre"><strong>Sobre</strong></a>
            </h6>
        </div>

        <div class="row no-gutters">
            <h6 class="mt-3 acessibilidadeh6">
                <i class=" mr-2" aria-hidden="true"></i>
                <a href="#" id="contactos"><strong>Contactos</strong></a>
            </h6>
        </div>
    </div>
</div>


<!--AJUDA-->
<div class="container ml-5" id="div_ajuda">
    <div class="no-gutters">

        <h1 class="mt-5 acessibilidadeh1">
            <i class="fa fa-info mr-2" aria-hidden="true"></i>
            Ajuda
        </h1>

        <h4 class="acessibilidadeh4"> <i class="fa fa-star"></i> Como incrementar a pontução?</h4>
        <p class="acessibilidadesmall">Para que a pontuação aumente basta partilhar o código com outros utilizadores (incremento de 10 pontos) ou participar em eventos (incremento de 500 pontos).</p>

        <h4 class="acessibilidadeh4"> <i class="fa fa-certificate"></i> Como ganhar medalhas?</h4>
        <p class="acessibilidadesmall">As medalhas que aparecem no perfil podem ser adquiridas através da pontuação (medalhas com desenho de um número) ou através da participação em Eventos, dependendo do tema em que se participa ganha-se um medalha, assim basta que apenas se particpe num evento.</p>

        <h4 class="acessibilidadeh4"> <i class="fa fa-trophy"></i> Como ganhar troféus?</h4>
        <p class="acessibilidadesmall">Para poder ganhar troféus é necessário participar em vários eventos pertencentes ao mesmo tema, dependendo do número de eventos que existam dentro desse tema podem ser necessárias de 6 a 8 presenças.</p>

        <h4 class="acessibilidadeh4"> <i class="fa fa-calendar"></i> Como posso organizar os meus próprios eventos?</h4>
        <p class="acessibilidadesmall">Para poder ter o papel de organizador de eventos é necessário ter participado em pelo menos 6 eventos, uma vez que é necessário perceber o funcionamento destes para os poder organizar.</p>

        <p class="acessibilidadesmall">
            <a href="definicoes.php">Voltar</a>
        </p>
    </div>
</div>


<!--SOBRE-->
<div class="container ml-5" id="div_sobre">
    <div class="no-gutters">
        <h1 class="mt-5 acessibilidadeh1">
            <i class="fa fa-info mr-2" aria-hidden="true"></i>
            Sobre
        </h1>

        <br>

        <p class="acessibilidadesmall">
            A BioInfluencers é uma rede social destinada unicamente à preservação do nosso planeta.
        </p>

        <p class="acessibilidadesmall">
            Foi criada no âmbito da unidade curricular de Laboratório Multimédia 4 - Perfil A do curso de Novas
            Tecnologias da Comunicação da
            Universidade de Aveiro.
            O grupo, constituído por Ana Filipa Ferreira, Ana Jorge Vaz, Eduardo Soeiro e Frederico Proença, teve esta
            ideia devido à crescente
            preocupação da população em tentar mudar o rumo que a Terra está a tomar. Assim, juntando as novas
            tecnologias e a preocupação ambiental,
            surgiu a BioInfluencers, uma rede social que vai mudar tudo e todos.
        </p>

        <p class="acessibilidadesmall">
            <a href="definicoes.php">Voltar</a>
        </p>
    </div>
</div>


<!--CONTACTOS-->
<div class="container ml-5" id="div_contactos">
    <div class="no-gutters">
        <h1 class="mt-5 acessibilidadeh1">
            <i class="fa fa-phone mr-2" aria-hidden="true"></i>
            Contactos
        </h1>

        <br>

        <p class="acessibilidadesmall">
            Tel: (+351)963 123 456 / 279 123 456

            <br> <br>

            E-mail: bioinfluencers@live.com.pt
        </p>

        <p class="acessibilidadesmall">
            <a href="definicoes.php">Voltar</a>
        </p>
    </div>
</div>



<script>

    /*function sliderChange(val) {

        document.getElementById('sliderStatus').innerHTML = val;
    }*/

    window.onload = function () {

        document.getElementById("div_ajuda").style.display = "none";
        document.getElementById("div_sobre").style.display = "none";
        document.getElementById("div_contactos").style.display = "none";

        document.getElementById("ajuda").onclick = function () {


            document.getElementById("div_ajuda").style.display = "block";
            document.getElementById("div_definicoes").style.display = "none";
        };


        document.getElementById("sobre").onclick = function () {


            document.getElementById("div_sobre").style.display = "block";
            document.getElementById("div_definicoes").style.display = "none";
        };


        document.getElementById("contactos").onclick = function () {


            document.getElementById("div_contactos").style.display = "block";
            document.getElementById("div_definicoes").style.display = "none";
        };
    };
</script>