<?php
include 'config/conf.php';
?>

<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="noindex,nofollow"/>
    <title>SGODP - SISTEMA DE GESTÃO DE OCORRÊNCIAS DISCIPLINARES PEDAGOGICAS</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="bg-dark">

<div class="main-wrapper">

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>


    <div
            class="
          auth-wrapper
          d-md-flex
          no-block
          justify-content-center
          align-items-center
          bg-dark
        "
    >
        <div class="col-md-6 col-sm-12 px-4">
            <div class="row">
                <div id="loginform" style="margin-top: 10rem!important">

                    <!-- Form -->
                    <form
                            class="form-horizontal"
                            id="loginform"
                            action="index.html"
                    >
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span
                                              class="input-group-text bg-success text-white h-100"
                                              id="basic-addon1"
                                      ><i class="mdi mdi-account fs-4"></i>
                                      </span>
                                    </div>
                                    <input
                                            type="text"
                                            class="form-control form-control-lg"
                                            placeholder="Usuário"
                                            aria-label="usuario"
                                            aria-describedby="basic-addon1"
                                            required=""
                                    />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span
                                              class="input-group-text bg-warning text-white h-100"
                                              id="basic-addon2"
                                      ><i class="mdi mdi-lock fs-4"></i>
                                      </span>
                                    </div>
                                    <input
                                            type="text"
                                            class="form-control form-control-lg"
                                            placeholder="Senha"
                                            aria-label="senha"
                                            aria-describedby="basic-addon1"
                                            required=""
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-3">
                                        <button
                                                class="btn btn-info"
                                                id="to-recover"
                                                type="button"
                                        >
                                            <i class="mdi mdi-lock me-1"></i> Recuperar senha?
                                        </button>
                                        <button
                                                class="btn btn-success float-end text-white"
                                                type="submit"
                                        >
                                            Entrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= BASE_URL ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(".preloader").fadeOut();
</script>
</body>
</html>

