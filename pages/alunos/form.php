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
        $query = "UPDATE aluno SET {$attr} WHERE id_matricula = '{$id}'";
    } else {
        $query = "INSERT INTO aluno SET {$attr}";
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
    $query = "SELECT * FROM aluno WHERE id_matricula = '{$id}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

}
?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Alunos</h4>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="alunos/index.php">Alunos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cadastrar alunos
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

            <form id="form-aluno" class="form-horizontal">
                <div class="form-group mt-3">
                    <label>Nome</label>
                    <input
                            type="text"
                            name="nome_aluno"
                            class="form-control date-inputmask"
                            id="date-mask"
                            placeholder="Entre com o nome do aluno"
                            value="<?= $d->nome_aluno ?>"
                    />
                </div>

                <div class="form-group">
                    <label>
                        Matrícula
                    </label>
                    <input
                            type="text"
                            name="id_matricula"
                            class="form-control phone-inputmask"
                            id="phone-mask"
                            placeholder="Entre com o matrícula do aluno"
                            value="<?= $d->id_matricula ?>"
                    />
                </div>

                <div class="form-group">
                    <label for="turma">Turma</label>
                    <div class="col-sm-11">
                        <select id="turma" class="form-control" name="id_turma">
                            <option value=""></option>
                            <?php
                            $query = "SELECT * FROM turma";
                            $result = mysqli_query($con, $query);
                            while ($t = mysqli_fetch_object($result)):?>
                                <option
                                        value="<?= $t->id_turma ?>"
                                    <?= $t->id_turma == $d->id_turma ? 'selected' : '' ?>
                                >
                                    <?= $t->numero_turma ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <input type="hidden" id="codigo" value="<?= $d->id_matricula ?>">

                <div class="border-top d-flex flex-row justify-content-between pt-4">
                    <a href="alunos/index.php">
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
        $('#form-aluno').submit(function (e) {
            e.preventDefault();

            if (!$(this).valid()) return false;

            var codigo = $('#codigo').val();
            var dados = $(this).serializeArray();
            var turma = $("#turma").val();

            if (codigo) {
                dados.push({name: 'id', value: codigo})
            }

            $.ajax({
                url: 'pages/alunos/form.php',
                method: 'POST',
                data: dados,
                dataType: 'JSON',
                success: function (data) {

                    if (data.status) {
                        alert('Sucesso', data.msg);

                        $.ajax({
                            url: 'pages/alunos/index.php',
                            data: {turma},
                            success: function (data) {
                                $('#home').html(data);
                            }
                        });
                    } else {
                        alert('Error: ' + data.msg);
                    }
                }
            })
        });
    });
</script>
