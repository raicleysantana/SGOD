<?php

$title = "Participantes";

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
        $query = "UPDATE participantes SET {$attr} WHERE part_id = '{$id}'";
    } else {
        $query = "INSERT participantes SET {$attr}";
    }

    try {
        $stm = $db->prepare($query);
        $stm->execute();

        $_SESSION['msg_sucesso'] = "Dados salvo com sucesso";

        $id = $id ?: $db->lastInsertId();

        header("Location: " . Config::$baseUrl . "/admin/cadastros/participantes/visualizar.php?id={$id}");
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

$participante = NULL;

if ($id) {
    $query = "SELECT * FROM participantes WHERE part_id = '{$id}'";
    $stm = $db->prepare($query);
    $stm->execute();

    $participante = $stm->fetch(PDO::FETCH_OBJ);
}
?>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h2 class="page-title">Participantes</h2>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                            <li class="breadcrumb-item">
                                <a href="<?= Config::$baseUrl ?>/admin/cadastros/participantes/index.php">Participantes</a>
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
                        <label for="part_nome">Nome</label>
                        <input
                                type="text"
                                class="form-control"
                                id="part_nome"
                                name="part_nome"
                                value="<?= $participante->part_nome ?>"
                                placeholder=""
                                required
                        >
                    </div>

                    <div class="form-group mt-3">
                        <label for="part_usuario">Usuário</label>
                        <input
                                type="text"
                                class="form-control"
                                id="part_usuario"
                                name="part_usuario"
                                value="<?= $participante->part_usuario ?>"
                                placeholder=""
                                required
                        >
                    </div>

                    <div class="form-group mt-3">
                        <label for="part_email">E-Mail</label>
                        <input
                                type="text"
                                class="form-control"
                                id="part_email"
                                name="part_email"
                                value="<?= $participante->part_email ?>"
                                placeholder=""
                                required
                        >
                    </div>

                    <div class="row">
                        <div class="form-group mt-3 col-md-6">
                            <label for="part_senha">Senha</label>
                            <input
                                    type="password"
                                    class="form-control"
                                    id="part_senha"
                                    name="part_senha"
                                    value="<?= $participante->part_senha ?>"
                                    placeholder=""
                                    required
                            >
                        </div>

                        <div class="form-group mt-3 col-md-6">
                            <label for="part_senha">Confirmar Senha</label>
                            <input
                                    type="password"
                                    class="form-control"
                                    id="part_senha"
                                    value=""
                                    placeholder=""
                                    required
                            >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label for="cgo_id">Cargo</label>
                                <select
                                        class="form-control"
                                        id="cgo_id"
                                        name="cgo_id"
                                        required
                                >
                                    <option value=""></option>
                                    <?php
                                    $stm = $db
                                        ->prepare("SELECT cgo_id, cgo_nome FROM cargos WHERE cgo_situacao = '1'");
                                    $stm->execute();
                                    $cargos = $stm->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($cargos as $cargo) { ?>
                                        <option
                                                value="<?= $cargo->cgo_id ?>"
                                            <?= ($id and $cargo->cgo_id == $participante->cgo_id) ? 'selected' : '' ?>
                                        ><?= $cargo->cgo_nome ?></option>
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
