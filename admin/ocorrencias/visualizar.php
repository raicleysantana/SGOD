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
    . "LEFT JOIN participantes p ON p.part_id = o.part_id "
    . "LEFT JOIN cargos c ON c.cgo_id = p.cgo_id "
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
                                <a href="<?= Config::$baseUrl ?>/admin/ocorrencias/listagem.php">Listagem de
                                    ocorrências</a>
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
                        <td class="fw-bold" style="width: 20%">Número</td>
                        <td colspan="3"><?= $d->ocr_numero ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Aluno</td>
                        <td colspan="3"><?= $d->alu_nome ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Responsável</td>
                        <td colspan="3"><?= $d->alu_nome_responsavel ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Turma</td>
                        <td colspan="3"><?= $d->turma_numero ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Data</td>
                        <td colspan="3"><?= date('d/m/Y H:s', strtotime($d->ocr_dtcriacao)) ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Tipo de Ocorrência</td>
                        <td colspan="3"><?= $d->tpo_nome ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Participante que registrou</td>
                        <td><?= $d->part_nome ?></td>
                        <td class="fw-bolder">Cargo</td>
                        <td><?= $d->cgo_nome ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Observação</td>
                        <td colspan="3"><?= $d->ocr_observacao ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bolder">Descrição</td>
                        <td colspan="3"><?= $d->ocr_descricao ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
include_once "../layout/_footer.php";
?>