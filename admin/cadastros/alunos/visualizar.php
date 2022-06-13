<?php

$title = "Turma - Visualizar";

require_once "../../../config/DBConnect.php";
require_once('../../layout/_header.php');
require_once("../../../config/Utils.php");
include_once "../../layout/navbar.php";
include_once "../../layout/_sidebar.php";

$id = $_GET['id'];

$db = DBConnect::PDO();

$query = "SELECT * FROM alunos WHERE alu_id = '{$id}'";
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
                            <a href="<?= Config::$baseUrl ?>/admin/cadastros/alunos/index.php">Alunos</a>
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
                <div class="col-md-9"><?= $d->alu_nome; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Nome do responsável</div>
                <div class="col-md-9"><?= $d->alu_nome_responsavel; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Data de Nascimento</div>
                <div class="col-md-9"><?= date('d/m/Y', strtotime($d->alu_dtnascimento)); ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Contato</div>
                <div class="col-md-9"><?= $d->alu_contato; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Situação</div>
                <div class="col-md-9"><?= Utils::situacao($d->alu_situacao); ?></div>
            </div>
        </div>
    </div>
</div>


<?php
include_once "../../layout/_footer.php";
