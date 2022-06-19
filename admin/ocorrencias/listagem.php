<?php
require_once "../../config/DBConnect.php";

$db = DBConnect::PDO();

$title = "Criar ocorrência";

require_once('../layout/_header.php');

include_once "../layout/navbar.php";
include_once "../layout/_sidebar.php";
include_once "../layout/breadcumbs.php";

?>


<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Listagem de ocorrências</h2>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Listagem de ocorrências
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
            <?php
            $search = "";
            $search_array = [];

            if ($_SERVER['REQUEST_METHOD'] === 'GET' and $_GET['acao'] === 'pesquisar') {
                unset($_GET['acao']);

                foreach ($_GET as $key => $value) {
                    if ($value) {
                        if ($key === 'alu_nome') {
                            $search_array[] = "{$key} LIKE '%{$value}%'";
                        } else {
                            $search_array[] = "o.{$key} = '{$value}'";
                        }
                    }
                }

                if ($search_array) $search = "AND " . implode(" AND ", $search_array);
            }

            $sql = "SELECT * FROM ocorrencias o "
                . "LEFT JOIN alunos a ON a.alu_id = o.alu_id "
                . "LEFT JOIN turmas t ON t.turma_id = o.turma_id "
                . "LEFT JOIN tipos_ocorrencia tpo ON tpo.tpo_id = o.tpo_id "
                . "WHERE true {$search} "
                . "ORDER BY o.ocr_dtcriacao DESC";
            $stm = $db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            #echo $sql;
            ?>

            <div class="col-md-12">
                <h4 class="mb-0">Filtros</h4>
                <form action="" class="my-4">

                    <input type="hidden" name="acao" value="pesquisar">

                    <div class="row">
                        <div class="col-lg-2">
                            <label for="ocr_numero" class="form-label">Nº. Ocorrencia</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    name="ocr_numero"
                                    id="ocr_numero"
                                    value="<?= $_GET['ocr_numero'] ?>"
                            >
                        </div>
                        <div class="col-lg col-md-6 col-sm-6">
                            <label for="alu_nome" class="form-label">Aluno</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    name="alu_nome"
                                    id="alu_nome"
                                    value="<?= $_GET['alu_nome'] ?>"
                            >
                        </div>

                        <div class="col-lg col-md-6 col-sm-6">
                            <label for="turma_id" class="form-label">Turma</label>
                            <select class="form-control" name="turma_id" id="turma_id">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM turmas ORDER BY turma_numero";
                                $stm_turma = $db->prepare($sql);
                                $stm_turma->execute();
                                $turmas = $stm_turma->fetchAll(PDO::FETCH_OBJ);

                                foreach ($turmas as $turma) { ?>
                                    <option
                                            value="<?= $turma->turma_id ?>"
                                        <?= ($_GET['turma_id'] and $_GET['turma_id'] == $turma->turma_id) ? ' selected ' : '' ?>
                                    ><?= $turma->turma_numero ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-lg col-md-6 col-sm-6">
                            <label for="tpo_id" class="form-label">Transgressão</label>
                            <select class="form-control" name="tpo_id" id="tpo_id">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM tipos_ocorrencia ORDER BY tpo_nome";
                                $stm_tipo_ocorrencia = $db->prepare($sql);
                                $stm_tipo_ocorrencia->execute();
                                $tipos_ocorrencia = $stm_tipo_ocorrencia->fetchAll(PDO::FETCH_OBJ);

                                foreach ($tipos_ocorrencia as $tpo) { ?>
                                    <option
                                            value="<?= $tpo->tpo_id ?>"
                                        <?= ($_GET['tpo_id'] and $_GET['tpo_id'] == $tpo->tpo_id) ? ' selected ' : '' ?>
                                    ><?= $tpo->tpo_nome ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-3 mb-2">
                        <button class="btn btn-success text-white float-end">Pesquisar</button>
                    </div>
                </form>

            </div>

            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10%">#</th>
                    <th>Aluno</th>
                    <th>Turma</th>
                    <th>Transgressão</th>
                    <th>Data</th>
                    <th>Ação</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $i = 1;
                foreach ($result as $row): ?>
                    <tr>
                        <td><?= $row->ocr_numero ?></td>
                        <td><?= $row->alu_nome ?></td>
                        <td><?= $row->turma_numero ?></td>
                        <td><?= $row->tpo_nome ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row->ocr_dtcriacao)) ?></td>
                        <td>
                            <a href="<?= Config::$baseUrl ?>/admin/ocorrencias/visualizar.php?id=<?= $row->ocr_id ?>">
                                <i class="mdi mdi-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>
</div>

<?php
include_once "../layout/_footer.php";
?>
