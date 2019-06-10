<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">

                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bem-vindo à BioInfluencers!</h1>
                                </div>
                                <?php
                                if (isset($_GET["msg"])) {
                                    $msg_show = true;
                                    switch ($_GET["msg"]) {
                                        case 0:
                                            $message = "Ocorreu um erro no registo, por favor tenta novamente!";
                                            $class = "alert-warning";
                                            break;
                                        case 1:
                                            $message = "Registo efectuado com sucesso";
                                            $class = "alert-success";
                                            break;
                                        case 2:
                                            $message = "Ocorreu um erro no login, por favor tenta novamente";
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