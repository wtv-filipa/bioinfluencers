<script>


    /*function sliderChange(val) {

        document.getElementById('sliderStatus').innerHTML = val;
    }*/

</script>



<!--Definições gerais-->
<div class="container" id="aumentoFonte">
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
                <a href="#"><strong>Sobre</strong></a>
            </h6>
        </div>

        <div class="row no-gutters">
            <h6 class="mt-3">
                <i class=" mr-2" aria-hidden="true"></i>
                <a href="#"><strong>Contactos</strong></a>
            </h6>
        </div>
    </div>
</div>
