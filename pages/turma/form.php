<?php
include '../../config/includes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $attr = [];

    $id = $data['id'] ?: null;

    unset($data['id']);


    foreach ($data as $name => $value) {
        $attr[] = "{$name} = '" . mysqli_real_escape_string($con, $value) . "'";
    }

    $attr = implode(', ', $attr);

    if ($id) {
        $query = "UPDATE turma SET {$attr} WHERE id_turma = '{$id}'";
    } else {
        $query = "INSERT INTO turma SET {$attr}";
    }

    if (mysqli_query($con, $query)) {
        $id = $id ?: mysqli_insert_id($con);

        echo json_encode([
            'status' => true,
            'msg' => 'Dados salvo com sucesso',
            'id' => $id,
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'msg' => 'Erro ao salvar',
            'codigo' => $id,
            'mysql_error' => mysqli_error($con),
        ]);
    }

    exit;
}

$id = $_GET['id'];

$d = [];

if ($id) {
    $query = "SELECT * FROM turma WHERE id_turma = '{$id}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

}
?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Turma</h4>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./home/content.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="turma/index.php">Turmas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cadastrar turma
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

            <form id="form-turma">
                <div class="form-group mt-3">
                    <label>Numero da turma</label>
                    <input
                            type="text"
                            class="form-control"
                            id="date-mask"
                            name="numero_turma"
                            placeholder="Entre o número da turma"
                            value="<?= $d->numero_turma ?>"
                    />
                </div>

                <input id="codigo" type="hidden" value="<?= $_GET['id'] ?>">
                <div class="border-top d-flex flex-row justify-content-between pt-4">
                    <a href="turma/index.php">
                        <button type="button" class="btn btn-secondary">
                            Voltar
                        </button>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(function () {
        $('#form-turma').submit(function (e) {
            e.preventDefault();

            if (!$(this).valid()) return false;

            var codigo = $('#codigo').val();
            var dados = $(this).serializeArray();

            if (codigo) {
                dados.push({name: 'id', value: codigo})
            }

            $.ajax({
                url: 'pages/turma/form.php',
                method: 'POST',
                data: dados,
                dataType: 'JSON',
                success: function (data) {

                    if (data.status) {
                        alert('Sucesso', data.msg);

                        $.ajax({
                            url: 'pages/turma/index.php',
                            success: function (data) {
                                $('#home').html(data);
                            }
                        });
                    } else {
                        alert('Error: ' + retorno.msg);
                    }
                }
            })
        });
    });
</script>

