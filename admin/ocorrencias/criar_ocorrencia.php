<?php
require_once "../../config/DBConnect.php";

$db = DBConnect::PDO();

if ($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['alu_id'])) {
    $alu_id = $_GET['alu_id'];

    $query = "SELECT t.turma_numero, t.turma_periodo, t.turma_id, a.alu_nome_responsavel FROM turma_aluno ta "
        . "INNER JOIN turmas t ON t.turma_id = ta.turma_id "
        . "INNER JOIN alunos a ON a.alu_id = ta.alu_id "
        . "WHERE ta.alu_id = '{$alu_id}'";

    $stm = $db->prepare($query);

    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' and $_POST['acao'] === 'criar_ocorrencia') {

    $data = $_POST;

    $query = "";
    $attr = [];
    unset($data['acao']);
    $data['ocr_numero'] = date('Y-m-d H:i:s');

    foreach ($data as $name => $value) {
        $attr[] = "{$name} = '{$value}'";
    }

    $attr = implode(', ', $attr);

    $query = "INSERT ocorrencias SET {$attr}";

    try {
        echo $query;
        $stm = $db->prepare($query);
        $stm->execute();

        $_SESSION['msg_sucesso'] = "Dados salvo com sucesso";

        $id = $db->lastInsertId();

        #header("Location: " . Config::$baseUrl . "/admin/cadastros/turmas/visualizar.php?id={$id}");
    } catch (Exception $e) {
        var_dump($e);
        die;
        $_SESSION['msg_error'] = "Error ao salvar";
    }

    exit();
}
$title = "Criar ocorrência";

require_once('../layout/_header.php');

include_once "../layout/navbar.php";
include_once "../layout/_sidebar.php";
include_once "../layout/breadcumbs.php";

?>

<link rel="stylesheet" href="<?= Config::$baseUrl; ?>/assets/vendor/select2/select2.min.css">

<style>
    .select2-container--default .select2-selection--single {
        border-radius: 0 !important;
        height: 35px;
        padding-top: 3px;
        padding-bottom: 3px;
    }

    .ocorrencia ul {
        list-style: none;
        column-count: 2;
        column-gap: 4rem;
    }
</style>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Criar ocorrência</h2>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cadastrar ocorrências
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="ocorrencia">
        <div class="row">
            <div class="card">
                <div class="card-body">

                    <form
                            class="needs-validation"
                            novalidate
                            action=""
                            method="POST">

                        <input type="hidden" name="part_id" value="<?= $_SESSION['id'] ?>">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mt-2">
                                    <label for="turma_numero">Aluno:</label>
                                    <select class="form-control select2" id="alu_id" name="alu_id" required>
                                        <option value=""></option>
                                        <?php
                                        $sql = "SELECT ta.alu_id, UPPER(a.alu_nome) AS alu_nome FROM turma_aluno ta "
                                            . "INNER JOIN alunos a ON a.alu_id = ta.alu_id "
                                            . "WHERE a.alu_situacao = '1' ORDER BY a.alu_nome";
                                        $stm = $db->prepare($sql);
                                        $stm->execute();

                                        $result = $stm->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($result as $row) { ?>
                                            <option value="<?= $row->alu_id ?>"><?= $row->alu_nome ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mt-2">
                                    <label for="turma_id">Turma:</label>
                                    <input type="text" id="turma_numero" class="form-control" value="" readonly>

                                    <input type="hidden" id="turma_id" name="turma_id" value="">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group mt-2">
                                    <label for="turma_periodo">Período:</label>
                                    <input type="text" id="turma_periodo" class="form-control" value="" readonly>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group mt-2">
                                    <label for="turma_periodo">Responsável:</label>
                                    <input type="text" id="alu_responsavel" class="form-control" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group mt-2">
                                    <label>Transgressão</label>
                                    <ul>
                                        <?php
                                        $stm = $db->prepare("SELECT tpo_id, tpo_nome FROM tipos_ocorrencia WHERE tpo_situacao = '1'");
                                        $stm->execute();
                                        $tipos_ocorrencias = $stm->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($tipos_ocorrencias as $tpo) { ?>
                                            <li>
                                                <div class="form-check mr-sm-2">
                                                    <input
                                                            type="radio"
                                                            class="form-check-input"
                                                            id="check_ocr_<?= $tpo->tpo_id ?>"
                                                            name="tpo_id"
                                                            value="<?= $tpo->tpo_id ?>"
                                                            required
                                                    />

                                                    <label
                                                            class="form-check-label mb-0"
                                                            for="check_ocr_<?= $tpo->tpo_id ?>"
                                                    ><?= $tpo->tpo_nome ?></label>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mt-2">
                                    <label for="ocr_observacao">Observações </label><small class="text-muted">
                                        (Opcional)</small>
                                    <textarea
                                            rows="4"
                                            id="ocr_observacao"
                                            name="ocr_observacao"
                                            class="form-control"
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="ocr_descricao">Descrição da Ocorrência </label><small class="text-muted">
                                (Opcional)</small>
                            <textarea
                                    rows="3"
                                    id="ocr_descricao"
                                    name="ocr_descricao"
                                    class="form-control"
                            ></textarea>
                        </div>

                        <div class="row col-lg-4">
                            <div class="form-group mt-2">
                                <label for="ocr_dtcriacao">Data e Hora: </label> <small class="text-muted">
                                    (Data e hora do ocorrido)
                                </small>
                                <input
                                        type="datetime-local"
                                        id="ocr_dtcriacao"
                                        name="ocr_dtcriacao"
                                        class="form-control"
                                        value=""
                                        required
                                >
                            </div>
                        </div>

                        <input
                                type="hidden"
                                name="acao"
                                value="criar_ocorrencia"
                        />

                        <div class="form-group mt-2">
                            <button class="btn btn-success text-white" type="submit">Registrar</button>
                            <button type="reset" class="btn btn-danger text-white">Limpar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= Config::$baseUrl ?>/assets/vendor/select2/select2.min.js"></script>
<script>
    $(function () {
        $("#alu_id").select2({
            allowClear: true,
            placeholder: "Busque por um aluno",
        });

        $("#alu_id").change(function () {
            var alu_id = $(this).val();

            $.ajax({
                url: 'criar_ocorrencia.php',
                data: {alu_id},
                dataType: 'json',
                success: function (response) {
                    $("#turma_numero").val(response.turma_numero);
                    $("#turma_periodo").val(response.turma_periodo);
                    $("#turma_id").val(response.turma_id);
                    $("#alu_responsavel").val(response.alu_nome_responsavel);
                }
            })
        });
    });
</script>
<?php
include_once "../layout/_footer.php";
?>


