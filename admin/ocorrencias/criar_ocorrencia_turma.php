<?php
require_once "../../config/DBConnect.php";
require_once "../../config/Config.php";
require_once "../../config/Utils.php";

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

    $alunos = $data['alunos'];

    unset($data['acao'], $data['alunos']);

    try {

        foreach ($alunos as $aluno_id):
            $attr = [];
            $query = "";

            $stm_ocr = $db->prepare("SELECT MAX(ocr_id) AS `max` FROM ocorrencias LIMIT 1");
            $stm_ocr->execute();
            $max = $stm_ocr->fetch(PDO::FETCH_OBJ)->max;
            $max = $max + 1;

            $data['ocr_numero'] = 'OC' . date('ymd') . $max;

            $data['part_id'] = $_SESSION['id'];
            $data['alu_id'] = $aluno_id;


            foreach ($data as $name => $value) {
                $attr[] = "{$name} = '{$value}'";
            }

            $attr_str = implode(', ', $attr);

            $query = "INSERT ocorrencias SET {$attr_str}";

            $stm = $db->prepare($query);
            $stm->execute();

        endforeach;

        $_SESSION['msg_sucesso'] = "Dados salvo com sucesso";

        header("Location: " . Config::$baseUrl . "/admin/ocorrencias/listagem.php");
    } catch (Exception $e) {
        $_SESSION['msg_error'] = "Error ao salvar";
    }

    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' and $_POST['select'] === 'select_periodo') {
    $periodo = $_POST['periodo'];

    $stm = $db->prepare("SELECT turma_id, turma_numero FROM turmas WHERE turma_periodo = '{$periodo}'");
    $stm->execute();
    $data = [];
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $item) {
        $data[] = $item;
    }

    echo json_encode($data);
    exit();
}
$title = "Criar ocorrência por turma";

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

    ul.transgressao {
        list-style: none;
        column-count: 2;
        column-gap: 4rem;
    }

    .select2-container {
        width: 100% !important;
    }
</style>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Criar ocorrência por turma</h2>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cadastrar ocorrências da
                            <turma></turma>
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
                            <div class="col-lg-6">
                                <div class="form-group mt-2">
                                    <label for="turma_periodo">Período:</label>
                                    <select id="turma_periodo" class="form-control" required>
                                        <option value=""></option>
                                        <?php foreach (Utils::getPeriodo() as $key => $value): ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-2">
                                    <label for="turma_id">Turma:</label>
                                    <select name="turma_id" id="turma_id" class="form-control" required>
                                        <option value=""></option>
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="form-group mt-2">
                            <label for="">Alunos</label>
                            <div class="container-alunos">
                                Nenhum aluno selecionado
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label>Transgressão</label>
                                    <ul class="transgressao">
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
                            <div class="col-md-6">
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
                            <label for="ocr_descricao">Descrição da Ocorrência </label><small
                                    class="text-muted">
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

        $("#turma_periodo").change(function () {
            var periodo = $(this).val();

            $.ajax({
                url: "criar_ocorrencia_turma.php",
                type: "POST",
                data: {
                    periodo,
                    select: 'select_periodo'
                },
                dataType: "json",
                success: function (response) {
                    let html = '<option value=""></option>';

                    response.map((item, index) => {
                        html += `<option value="${item.turma_id}">${item.turma_numero}</option>`;
                    })
                    //html += ``;
                    $("#turma_id").html(html);
                }
            });
        });

        $("#turma_id").change(function () {
            var turma_id = $(this).val();

            $.ajax({
                url: "lista_alunos.php",
                type: "POST",
                data: {turma_id},
                dataType: "html",
                success: function (response) {
                    $(".container-alunos").hide().html(response).fadeIn();
                }
            });
        })
    });
</script>
<?php
include_once "../layout/_footer.php";
?>


