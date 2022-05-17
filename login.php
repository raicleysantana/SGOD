<?php
include 'config/includes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $query = "SELECT id_participante FROM participante "
        . "WHERE email = '{$email}' and senha = '{$senha}' LIMIT 1";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result)) {
        $d = mysqli_fetch_object($result);
        $_SESSION['participante']['id'] = $d->id_participante;

        echo json_encode(['status' => true, 'data' => $d]);
    } else {
        echo json_encode([
            'status' => false,
            'msg' => 'Participante não encontrado'
        ]);
    }

    exit();
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="noindex,nofollow"/>
    <title>SGODP - SISTEMA DE GESTÃO DE OCORRÊNCIAS DISCIPLINARES PEDAGOGICAS</title>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/icons/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/icons/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/login/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login/main.css">
    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form id="form-login" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Login para continuar
					</span>

                <div class="wrap-input100 validate-input" data-validate="E-Mail válido é requerido">
                    <input
                            class="input100"
                            type="text"
                            name="email"
                    >
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Senha é obrigatório">
                    <input
                            class="input100"
                            type="password"
                            name="senha"
                    >
                    <span class="focus-input100"></span>
                    <span class="label-input100">Senha</span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input
                                class="input-checkbox100"
                                id="ckb1"
                                type="checkbox"
                                name="remember-me"
                        >
                        <label class="label-checkbox100" for="ckb1">
                            Lembrar de mim
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1">
                            Esqueceu a senha?
                        </a>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Entrar
                    </button>
                </div>
            </form>

            <div
                    class="login100-more"
                    style="background-image: url('assets/images/44571.png');"
            >
            </div>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="assets/js/main.js"></script>


<script>
    $(".preloader").fadeOut();

    $('#form-login').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'login.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    window.location = './';
                } else {
                    alert(data.msg);
                }
            }
        })
    });
</script>
</body>
</html>

