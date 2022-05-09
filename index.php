<?php
include 'config/conf.php';
?>

<!DOCTYPE html>
<html dir="ltr" lang="pt-BR ">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="robots" content="noindex,nofollow"/>
    <title>SGODP - SISTEMA DE GESTÃO DE OCORRÊNCIAS DISCIPLINARES PEDAGOGICAS</title>

    <!-- Suporte para HTML5 Shim e Respond.js IE8 de elementos HTML5 e consultas de mídia -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.min.css">
    <link
            href="<?= BASE_URL ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
            rel="stylesheet"
    />
</head>

<body>

<div>
    <?php include "pages/home/index.php"; ?>
</div>

<script src="<?= BASE_URL ?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= BASE_URL ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/waves.js"></script>
<script src="<?= BASE_URL ?>/assets/js/sidebarmenu.js"></script>
<script src="<?= BASE_URL ?>/assets/js/custom.min.js"></script>
<script src="<?= BASE_URL ?>/assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
    $(function () {
        $(document).on('click', 'a', function (e) {
            e.preventDefault();

            let url = $(this).attr('href');

            if (['javascript:void(0)', '#'].includes(url)) return false;

            $(".preloader").show();

            $.ajax({
                url: `pages/${url}`,
                success: function (data) {
                    $('#home').html(data);
                },
                complete: function (data) {
                    $(".preloader").fadeOut();
                }
            })
                .fail(function (error) {
                    alert(`Error: ${error.statusText}`);
                });
        });
    });
</script>
</body>
</html>