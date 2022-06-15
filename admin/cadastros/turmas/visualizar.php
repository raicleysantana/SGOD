<?php

require_once "../../../config/DBConnect.php";
$db = DBConnect::PDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST' and $_POST['acao'] === 'adicionar_aluno') {

    try {
        $stm = $db->prepare("INSERT INTO turma_aluno SET turma_id = :turma_id, alu_id = :alu_id");
        $stm->bindParam(':turma_id', $_POST['turma_id']);
        $stm->bindParam(':alu_id', $_POST['alu_id']);
        $stm->execute();
        $_SESSION['msg_sucesso'] = "Aluno Cadastrado com sucesso!";
    } catch (Exception $e) {
        $_SESSION['msg_error'] = $e;
    }
}

$title = "Turma - Visualizar";

require_once('../../layout/_header.php');
require_once("../../../config/Utils.php");
include_once "../../layout/navbar.php";
include_once "../../layout/_sidebar.php";


$id = $_GET['id'];


$query = "SELECT * FROM turmas WHERE turma_id = '{$id}'";
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
                            <a href="<?= Config::$baseUrl ?>/admin/cadastros/turmas/index.php">Turmas</a>
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
                <div class="col-md-3">Número</div>
                <div class="col-md-9"><?= $d->turma_numero; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Período</div>
                <div class="col-md-9"><?= Utils::periodo($d->turma_periodo); ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Situação</div>
                <div class="col-md-9"><?= Utils::situacao($d->turma_situacao); ?></div>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <h4 class="page-title">Alunos</h4>

                <button class="text-white btn btn-success adicionar-aluno">
                    Adicionar aluno
                </button>
            </div>

            <div class="mt-3">
                <table class="datatable table table-hover">
                    <thead>
                    <tr>
                        <td style="width: 10%">#</td>
                        <td style="width: 65%">Aluno</td>
                        <td style="width: 25%">Ação</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT a.alu_nome,ta.turma_id, ROW_NUMBER() OVER(PARTITION BY talu_id) AS row_num FROM turma_aluno ta "
                        . "LEFT JOIN alunos a on a.alu_id = ta.alu_id "
                        . "WHERE ta.turma_id = '{$d->turma_id}'";

                    $db = DBConnect::PDO();
                    $stm = $db->prepare($query);
                    $stm->execute();
                    $lista = $stm->fetchAll(PDO::FETCH_OBJ);

                    if (count($lista) > 0):
                        foreach ($lista as $row): ?>
                            <tr>
                                <td><?= $row->row_num; ?></td>
                                <td><?= $row->alu_nome ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<input type="hidden" id="turma_id" value="<?= $d->turma_id; ?>">

<?php
include_once "../../layout/_footer.php";
?>

<script>
    $(function () {
        $(".adicionar-aluno").click(function () {
            var turma_id = $('#turma_id').val();

            $.dialog({
                title: "Adicionar Aluno",
                content: function () {
                    var self = this;

                    return $.ajax({
                        url: 'ajax_adicionar_aluno.php',
                        dataType: 'html',
                        data: {turma_id},
                        method: 'get'
                    }).done(function (response) {
                        self.setContent(response);
                    }).fail(function () {
                        self.setContent('Something went wrong.');
                    });
                },
                columnClass: 'medium',
            })
        });
    })
</script>
