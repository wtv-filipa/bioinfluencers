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

        <h6><a href="#">Notificações</a></h6>

        <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>

        <br> <br>

        <h6><a href="#">Conta</a></h6>

        <br> <br>

        <h6><a href="#">Privacidade e segurança</a></h6>

        <br> <br>

        <h6><a href="#">Segurança</a></h6>

    </div>

    <br> <br>

    <!--Acessibilidade-->

    <div class="row no-gutters">
        <h4 class="mt-5">
            <i class="fa fa-hand-paper-o mr-2" aria-hidden="true"></i>
            Acessibilidade
        </h4>

    </div>


    <div class="container w-75 mx-auto">
        <br>
        <h6>Legendas</h6>
        <br> <br>
        <h6>Idioma</h6>
        <br> <br>
        <h6>Som</h6>

        <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>


        <br> <br>
        <h6 id="tamanhoFontetxt">Tamanho da fonte</h6>

        <!--<span class="slidecontainer">
            <input type="range" min="1" max="100" value="50" class="sliderfonte" id="myRange" step="1" onchange="sliderChange(this.value)">

            slider value = <span id="sliderStatus">50</span>
        </span>-->
        <button type="button" class="btn btn-success operador">-</button>
        <button type="button" class="btn btn-success operador">+</button>
    </div>


    <!--Restantes-->
    <div class="mb-0">
        <div class="row no-gutters">
            <h6 class="mt-5">
                <i class=" mr-2" aria-hidden="true"></i>
                <a href="#" id="ajuda"><strong>Ajuda</strong></a>
            </h6>
        </div>

        <div class="row no-gutters">
            <h6 class="mt-3">
                <i class=" mr-2" aria-hidden="true"></i>
                <a href="#" id="sobre"><strong>Sobre</strong></a>
            </h6>
        </div>

        <div class="row no-gutters">
            <h6 class="mt-3">
                <i class=" mr-2" aria-hidden="true"></i>
                <a href="#" id="contactos"><strong>Contactos</strong></a>
            </h6>
        </div>
    </div>
</div>


<!--AJUDA-->
<div class="container ml-5" id="div_ajuda">
    <div class="no-gutters">

        <h4 class="mt-5">
            <i class="fa fa-info mr-2" aria-hidden="true"></i>
            Ajuda
        </h4>

        <p>
            Aqui vamos adicionar as ajudas da BioInfluencers
        </p>

        <p>
            <a href="definicoes.php">Voltar</a>
        </p>
    </div>
</div>


<!--SOBRE-->
<div class="container ml-5" id="div_sobre">
    <div class="no-gutters">
        <h4 class="mt-5">
            <i class="fa fa-info mr-2" aria-hidden="true"></i>
            Sobre
        </h4>

        <br>

        <p>
            A BioInfluencers é uma rede social destinada unicamente à preservação do nosso planeta.
        </p>

        <p>
            Foi criada no âmbito da unidade curricular de Laboratório Multimédia 4 - Perfil A do curso de Novas
            Tecnologias da Comunicação da
            Universidade de Aveiro.
            O grupo, constituído por Ana Filipa Ferreira, Ana Jorge Vaz, Eduardo Soeiro e Frederico Proença, teve esta
            ideia devido à crescente
            preocupação da população em tentar mudar o rumo que a Terra está a tomar. Assim, juntando as novas
            tecnologias e a preocupação ambiental,
            surgiu a BioInfluencers, uma rede social que vai mudar tudo e todos.
        </p>

        <p>
            <a href="definicoes.php">Voltar</a>
        </p>
    </div>
</div>


<!--CONTACTOS-->
<div class="container ml-5" id="div_contactos">
    <div class="no-gutters">
        <h4 class="mt-5">
            <i class="fa fa-phone mr-2" aria-hidden="true"></i>
            Contactos
        </h4>

        <br>

        <p>
            Tel: (+351)963 123 456 / 279 123 456

            <br> <br>

            E-mail: bioinfluencers@live.com.pt
        </p>

        <p>
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