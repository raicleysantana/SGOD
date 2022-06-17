<?php

$title = "Alunos";
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
        $query = "UPDATE alunos SET {$attr} WHERE alu_id = '{$id}'";
    } else {
        $query = "INSERT alunos SET {$attr}";
    }

    #var_dump($query);
    #die;

    try {
        $stm = $db->prepare($query);
        $stm->execute();

        $_SESSION['msg_sucesso'] = "Dados salvo com sucesso";

        $id = $id ?: $db->lastInsertId();

        header("Location: " . Config::$baseUrl . "/admin/cadastros/alunos/visualizar.php?id={$id}");
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

$aluno = NULL;

if ($id) {
    $query = "SELECT * FROM alunos WHERE alu_id = '{$id}'";
    $stm = $db->prepare($query);
    $stm->execute();

    $aluno = $stm->fetch(PDO::FETCH_OBJ);
}
?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Alunos</h2>
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
            <h5 class="card-title mb-0">Formulário</h5>

            <form class="needs-validation" novalidate action="form.php<?= $id ? "?id={$id}" : '' ?>" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">

                <div class="form-group mt-3">
                    <label for="alu_nome">Nome do aluno</label>
                    <input type="text" class="form-control" id="alu_nome" name="alu_nome" value="<?= $aluno->alu_nome ?>" required placeholder="" required>
                </div>

                <div class="form-group mt-3">
                    <label for="alu_nome_responsavel">Nome do Responsavél</label>
                    <input type="text" class="form-control" id="alu_nome_responsavel" name="alu_nome_responsavel" value="<?= $aluno->alu_nome_responsavel ?>" required placeholder="" required>
                </div>

                <div class="form-group mt-3">
                    <label for="alu_dtnascimento">Data de nascimento</label>
                    <input type="date" class="form-control" id="alu_dtnascimento" name="alu_dtnascimento" value="<?= $aluno->alu_dtnascimento ?>" required placeholder="" required>
                </div>

                <div class="form-group mt-3">
                    <label for="alu_contato">Contato</label>
                    <input type="text" class="form-control" id="alu_contato" name="alu_contato" value="<?= $aluno->alu_contato ?>" placeholder="">
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="turma_numero">Situação</label>
                            <select class="form-control" id="alu_situacao" name="alu_situacao" required>
                                <option value=""></option>
                                <?php foreach (Utils::getSituacao() as $key => $situacao) { ?>
                                    <option value="<?= $key ?>" <?= ($id and $key == $aluno->aluno_situacao) ? 'selected' : '' ?>><?= $situacao ?></option>
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

<script>
    $(function() {
        $("#alu_contato").mask("(00) 90000-0000");
    });
</script>
<?php
include_once "../../layout/_footer.php";
?>