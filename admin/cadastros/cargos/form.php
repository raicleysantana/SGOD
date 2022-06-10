<?php

$title = "Cargos";
require_once "../../../config/DBConnect.php";
require_once "../../../config/Config.php";

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
        $query = "UPDATE cargos SET {$attr} WHERE cgo_id = '{$id}'";
    } else {
        $query = "INSERT cargos SET {$attr}";
    }

    try {
        $stm = $db->prepare($query);
        $stm->execute();

        $_SESSION['msg_sucesso'] = "Dados salvo com sucesso";

        $id = $id ?: $db->lastInsertId();

        header("Location: " . Config::$baseUrl . "/admin/cadastros/cargos/visualizar.php?id={$id}");
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

$cargo = NULL;

if ($id) {
    $query = "SELECT * FROM cargos WHERE cgo_id = '{$id}'";
    $stm = $db->prepare($query);
    $stm->execute();

    $cargo = $stm->fetch(PDO::FETCH_OBJ);
}
?>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h2 class="page-title">Cargos</h2>
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
                <h5 class="card-title mb-0">Formulário</h5>

                <form
                        class="needs-validation"
                        novalidate
                        action="form.php<?= $id ? "?id={$id}" : '' ?>"
                        method="POST"
                >
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <div class="form-group mt-3">
                        <label for="cgo_nome">Nome</label>
                        <input
                                type="text"
                                class="form-control"
                                id="cgo_nome"
                                name="cgo_nome"
                                value="<?= $cargo->cgo_nome ?>"
                                placeholder=""
                                required
                        >
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mt-3">
                                <label for="cgo_situacao">Situação</label>
                                <select
                                        class="form-control"
                                        id="cgo_situacao"
                                        name="cgo_situacao"
                                        required
                                >
                                    <option value=""></option>
                                    <?php foreach (Utils::getSituacao() as $key => $situacao) { ?>
                                        <option value="<?= $key ?>" <?= ($id and $key == $cargo->cgo_situacao) ? 'selected' : '' ?>><?= $situacao ?></option>
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
