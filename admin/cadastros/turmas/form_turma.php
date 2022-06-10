<?php

$title = "Turmas";
require_once "../../../config/DBConnect.php";
$db = DBConnect::PDO();

if ($_POST) {
    $data = $_POST;
    $id = $data['id'];
    unset($data['id']);

    $query = "";
    $attr = [];

    foreach ($data as $name => $value) {
        $attr[] = "{$name} = '{$value}'";
    }

    $attr = implode(', ', $attr);

    if ($id) {
        $query = "UPDATE turmas SET {$attr} WHERE turma_id = '{$id}'";
    } else {
        $query = "INSERT turmas SET {$attr}";
    }

    try {
        $stm = $db->prepare($query);
        $stm->execute();

        $_SESSION['msg_sucesso'] = "Dados salvo com sucesso";
    } catch (Exception $e) {
        $_SESSION['msg_error'] = "Error ao salvar";
    }
}

require_once('../../layout/_header.php');
require_once("../../../config/Utils.php");


include_once "../../layout/navbar.php";
include_once "../../layout/_sidebar.php";
?>


<?php


$id = $_GET['id'] ?: '';

$turma = NULL;

if ($id) {
    $query = "SELECT * FROM turmas WHERE turma_id = '{$id}'";
    $stm = $db->prepare($query);
    $stm->execute();

    $turma = $stm->fetch(PDO::FETCH_OBJ);
}
?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Turmas</h2>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                        <li class="breadcrumb-item">
                            <a href="<?= Config::$baseUrl ?>/admin/cadastros/turmas/turmas.php">Turmas</a>
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
            <h5 class="card-title mb-0">Formulário</h5>

            <form class="needs-validation" novalidate action="form_turma.php<?= $id ? "?id={$id}" : '' ?>" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">

                <div class="form-group mt-3">
                    <label for="turma_numero">Número</label>
                    <input type="text" class="form-control" id="turma_numero" name="turma_numero" value="<?= $turma->turma_numero ?>" required placeholder="" required>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="turma_numero">Situação</label>
                            <select class="form-control" id="turma_situacao" name="turma_situacao" required>
                                <option value=""></option>
                                <?php foreach (Utils::getSituacao() as $key => $situacao) { ?>
                                    <option value="<?= $key ?>" <?= ($id and $key == $turma->turma_situacao) ? 'selected' : '' ?>><?= $situacao ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3 border-top pt-4">
                    <button type="submit" class="btn btn-success text-white">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../../layout/_footer.php";
