<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <img class="pb-5" src="img/logo_n.png">
                                    <h1 class="h4 text-gray-900 mb-4">Bem-vindo à BioInfluencers!</h1>
                                </div>
                                <?php
                                if (isset($_GET["msg"])) {
                                    $msg_show = true;
                                    switch ($_GET["msg"]) {
                                        case 0:
                                            $message = "Credenciais erradas, por favor tente novamente.";
                                            $class = "alert-warning";
                                            break;
                                        case 1:
                                            $message = "Utilizador inválido.";
                                            $class = "alert-warning";
                                            break;
                                        case 2:
                                            $message = "ocorreu um erro ao fazer login, por favor tente novamente...";
                                            $class = "alert-warning";
                                            break;
                                        default:
                                            $msg_show = false;
                                    }

                                    echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
                                    if ($msg_show) {
                                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                    }
                                }
                                ?>
                                <form method="post" role="form" id="register-form" action="scripts/login.php">

                                    <div class="form-group">
                                        <label for="input2EmailForm" class="sr-only form-control-label">nickname</label>
                                        <div class="mx-auto col-sm-10">
                                            <input type="text" class="form-control" id="input2UserForm" name="nickname"
                                                   placeholder="nickname"
                                                   required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input2PasswordForm" class="sr-only form-control-label">password</label>
                                        <div class="mx-auto col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="password" required="required"
                                                   onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                                            <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.php">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>