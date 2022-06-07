<?php
include_once __DIR__ . "/../../config/Config.php";

?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?= Config::$baseUrl ?>/assets/css/style.min.css">
    <link rel="stylesheet" href="<?= Config::$baseUrl ?>/assets/vendor/jquery-confirm/css/jquery-confirm.min.css" />

    <script type="application/javascript" src="<?= Config::$baseUrl ?>/assets/libs/jquery/dist/jquery.min.js"></script>


    <style>
        .page-wrapper {
            min-height: 90vh;
        }
    </style>
</head>

<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">