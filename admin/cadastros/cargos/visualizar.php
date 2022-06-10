<?php

$title = "Cargo - Visualizar";

require_once "../../../config/DBConnect.php";
require_once('../../layout/_header.php');
require_once("../../../config/Utils.php");
include_once "../../layout/navbar.php";
include_once "../../layout/_sidebar.php";

$id = $_GET['id'];

$db = DBConnect::PDO();

$query = "SELECT * FROM cargos WHERE cgo_id = '{$id}'";
$stm = $db->prepare($query);
$stm->execute();

$d = $stm->fetch(PDO::FETCH_OBJ);

?>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h2 class="page-title">Visualizar</h2>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                            <li class="breadcrumb-item">
                                <a href="<?= Config::$baseUrl ?>/admin/cadastros/cargos/index.php">Cargos</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?= !$id ? 'Cadastrar' : 'Editar' ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">Nome</div>
                    <div class="col-md-9"><?= $d->cgo_nome; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3">Situação</div>
                    <div class="col-md-9"><?= Utils::situacao($d->cgo_situacao); ?></div>
                </div>
            </div>
        </div>
    </div>


<?php
include_once "../../layout/_footer.php";
