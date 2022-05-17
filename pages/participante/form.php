<?php
include '../../config/includes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $attr = [];

    $id = $data['id'] ?: null;

    unset($data['id']);

    $data['senha'] = md5($data['senha']);

    foreach ($data as $name => $value) {
        $attr[] = "{$name} = '" . mysqli_real_escape_string($con, $value) . "'";
    }

    $attr = implode(', ', $attr);

    if ($id) {
        $query = "UPDATE participante SET {$attr} WHERE id_participante = '{$id}'";
    } else {
        $query = "INSERT INTO participante SET {$attr}";
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
    $query = "SELECT * FROM participante WHERE id_participante = '{$id}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

}
?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Servidor</h4>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./home/content.php">Início</a></li>
                        <li class="breadcrumb-item"><a href="participante/index.php">Servidor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cadastrar servidor
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
                    <label>Nome</label>
                    <input
                            type="text"
                            class="form-control"
                            id="date-mask"
                            name="nome_participante"
                            placeholder="Entre com o nome do servidor"
                            value="<?= $d->nome_participante ?>"
                    />
                </div>

                <div class="form-group mt-3">
                    <label>Cargo</label>
                    <select class="form-control" name="id_cargo" id="cargo">
                        <option value=""></option>
                        <?php

                        $result = mysqli_query($con, "SELECT * FROM cargo ORDER BY tipo_cargo");
                        while ($c = mysqli_fetch_object($result)): ?>
                            <option
                                    value="<?= $c->id_cargo ?>"
                                <?= $c->id_cargo == $d->id_cargo ? 'selected' : '' ?>
                            >
                                <?= $c->tipo_cargo ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label>E-Mail</label>
                    <input
                            type="email"
                            class="form-control"
                            id="date-mask"
                            name="email"
                            placeholder="Entre com o email do servidor"
                            value="<?= $d->email ?>"
                    />
                </div>

                <?php if (!$id): ?>
                    <div class="form-group mt-3">
                        <label>Senha</label>
                        <input
                                type="text"
                                class="form-control"
                                id="date-mask"
                                name="senha"
                                placeholder="Entre com a senha do servidor"
                                value="<?= $d->senha ?>"
                        />
                    </div>
                <?php endif; ?>

                <input id="codigo" type="hidden" value="<?= $_GET['id'] ?>">
                <div class="border-top d-flex flex-row justify-content-between pt-4">
                    <a href="participante/index.php">
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
                url: 'pages/participante/form.php',
                method: 'POST',
                data: dados,
                dataType: 'JSON',
                success: function (data) {

                    if (data.status) {
                        $.alert('Sucesso', data.msg);

                        $.ajax({
                            url: 'pages/participante/index.php',
                            success: function (data) {
                                $('#home').html(data);
                            }
                        });
                    } else {
                        $.alert('Error: ' + retorno.msg);
                    }
                }
            })
        });
    });
</script>

