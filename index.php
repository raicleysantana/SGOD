<?php
include_once "config/DBConnect.php";
include_once "config/Autenticacao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $autenticacao = new Autenticacao();

    if ($autenticacao->login($usuario, $senha)) {
        $autenticacao->authLogin();
        exit();
    } else {
        $msg = "Usuário não encontrado";
    }

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

    <link rel="stylesheet" href="assets/css/login/main.css">
    <link rel="stylesheet" href="assets/css/login/util.css">
    <link rel="stylesheet" href="assets/css/style.min.css">

    <script type="application/javascript" src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script type="application/javascript" src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="application/javascript" src="assets/js/main.js"></script>

</head>

<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form id="form-login" method="post" action="" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Login para continuar
					</span>

                <div class="form-floating mb-3">
                    <input
                            type="text"
                            class="form-control"
                            id="usuario"
                            name="usuario"
                            placeholder="Usuário"
                    >
                    <label for="usuario">Usuário</label>
                </div>
                <div class="form-floating">
                    <input
                            type="password"
                            class="form-control"
                            id="senha"
                            name="senha"
                            placeholder="Senha"
                            autocomplete="new-password"
                    >
                    <label for="senha">Senha</label>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32 mt-3">
                    <div class="form-check">
                        <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="flexCheckDefault"
                        >
                        <label class="form-check-label" for="flexCheckDefault">
                            Lembrar de mim
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1">
                            Esqueceu a senha?
                        </a>
                    </div>
                </div>
                <?php if (!empty($msg)): ?>
                    <div class="text-center text-danger mb-2"><?= $msg ?></div>
                <?php endif; ?>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Entrar
                    </button>
                </div>
            </form>

            <div
                    class="login100-more"
                    style="background-image: url('img/background_aside.png');"
            >
            </div>
        </div>
    </div>
</div>


</body>
</html>

