<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>

                        <form method="post" role="form" id="register-form" action="scripts/registo.php">
                            <div class="form-group">
                                <label class="text-gray-800" for="username">Username</label>
                                <div class="col-sm-10 p-0 m-0">
                                    <input type="text" class="form-control" id="input2UserForm" name="nome"
                                           placeholder="username"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="nickname">Nickname</label>
                                <div class="col-sm-10 p-0 m-0">
                                    <input type="text" class="form-control" id="input2UserForm" name="nickname"
                                           placeholder="nickname"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="email">Email</label>
                                <div class="col-sm-10 p-0 m-0">
                                    <input type="email" class="form-control" id="input2EmailForm" name="email"
                                           placeholder="email"
                                           required="required" onchange="email_validate(this.value);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="data_nasc">Data de nascimento</label>
                                <div class="col-sm-10 p-0 m-0">
                                    <input type="date" class="form-control" id="data_nasc" name="data_nasc"
                                           placeholder="data de nascimento">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="pass">Password</label>
                                <div class="col-sm-10 p-0 m-0">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="password" required="required"
                                           onkeyup="checkPass(); return false;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-gray-800" for="vpass">Verify password</label>
                                <div class="col-sm-10 p-0 m-0">
                                    <input type="password" class="form-control" id="password_confirm"
                                           placeholder="verify password" required="required"
                                           onkeyup="checkPass(); return false;">
                                    <span id="confirmMessage" class="confirmMessage"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Register
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.php">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>