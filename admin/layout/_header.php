<?php
include_once __DIR__ . "/../../config/Config.php";

?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" href="<?= Config::$baseUrl ?>/assets/css/style.min.css">
    <link rel="stylesheet" href="<?= Config::$baseUrl ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <script
            type="application/javascript"
            src="<?= Config::$baseUrl ?>/assets/libs/jquery/dist/jquery.min.js"
    ></script>

    <script type="application/javascript"
            src="<?= Config::$baseUrl ?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"
    ></script>

    <script type="application/javascript"
            src="<?= Config::$baseUrl ?>/assets/vendor/jquery/jquery.validate.min.js"
    ></script>

    <script type="application/javascript"
            src="<?= Config::$baseUrl ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"
    ></script>

    <script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/js/sidebarmenu.js"></script>
    <script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/js/waves.js"></script>
    <script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/js/custom.min.js"></script>
    <script
            type="application/javascript"
            src="<?= Config::$baseUrl ?>/assets/extra-libs/DataTables/datatables.min.js"
    ></script>

    <style>
        .page-wrapper {
            min-height: 90vh;
        }
    </style>
</head>
<body>
<div
        id="main-wrapper"
        data-layout="vertical"
        data-navbarbg="skin5"
        data-sidebartype="full"
        data-sidebar-position="absolute"
        data-header-position="absolute"
        data-boxed-layout="full"
>


