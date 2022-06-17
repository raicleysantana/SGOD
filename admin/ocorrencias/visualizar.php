<?php
require_once "../../config/DBConnect.php";

$db = DBConnect::PDO();

$title = "Visualizar";

require_once('../layout/_header.php');

include_once "../layout/navbar.php";
include_once "../layout/_sidebar.php";

$id = $_GET['id'];

$sql = "SELECT * FROM ocorrencias o "
    . "LEFT JOIN alunos a ON a.alu_id = o.alu_id "
    . "LEFT JOIN turmas t ON t.turma_id = o.turma_id "
    . "LEFT JOIN tipos_ocorrencia tpo ON tpo.tpo_id = o.tpo_id "
    . "WHERE o.ocr_id = '{$id}' ";

$stm = $db->prepare($sql);
$stm->execute();

$d = $stm->fetch(PDO::FETCH_OBJ);

?>

<style>
    table td {
        padding: 0.6rem 1rem !important;
    }
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Visualizar ocorrência</h2>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                        <li class="breadcrumb-item">
                            <a href="<?= Config::$baseUrl ?>/admin/ocorrencias/listagem.php">Listagem de ocorrências</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Visualizar ocorrências
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
            <div class="d-flex flex-row justify-content-end mb-2">
                <button class="btn btn-danger"><i class="fas fa-file-pdf"></i> Imprimir</button>
            </div>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td style="width: 20%">Número</td>
                    <td><?= $d->ocr_numero ?></td>
                </tr>
                <tr>
                    <td>Aluno</td>
                    <td><?= $d->alu_nome ?></td>
                </tr>
                <tr>
                    <td>Responsável</td>
                    <td><?= $d->alu_nome_responsavel ?></td>
                </tr>
                <tr>
                    <td>Turma</td>
                    <td><?= $d->turma_numero ?></td>
                </tr>
                <tr>
                    <td>Data</td>
                    <td><?= date('d/m/Y H:s', strtotime($d->ocr_dtcriacao)) ?></td>
                </tr>
                <tr>
                    <td>Tipo de Ocorrência</td>
                    <td><?= $d->tpo_nome ?></td>
                </tr>
                <tr>
                    <td>Observação</td>
                    <td><?= $d->ocr_observacao ?></td>
                </tr>
                <tr>
                    <td>Descrição</td>
                    <td><?= $d->ocr_descricao ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once "../layout/_footer.php";
?>