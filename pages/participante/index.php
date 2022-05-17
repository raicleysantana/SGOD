<?php
include '../../config/includes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' and $_POST['acao'] === 'excluir') {
    $id = $_POST['id'];

    $query = "DELETE FROM participante WHERE id_participante = '{$id}'";;

    if (mysqli_query($con, $query)) {
        echo json_encode(["status" => true, "msg" => "Registro excluído com sucesso"]);
    } else {
        echo json_encode(["status" => false, "msg" => "Error ao tentar excluír"]);
    }
    exit();
}

?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Servidores</h4>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home/content.php">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Servidores
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between mb-3">
                        <h5 class="card-title">Servidores</h5>

                        <a href="participante/form.php">
                            <button type="button" class="btn btn-success btn-sm text-white">
                                Novo
                            </button>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Cargo</th>
                                <th style="width: 25%">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM participante p "
                                . "LEFT JOIN cargo c ON p.id_cargo = c.id_cargo";

                            $result = mysqli_query($con, $query);
                            while ($d = mysqli_fetch_object($result)):
                                ?>
                                <tr>
                                    <td><?= $d->id_participante ?></td>
                                    <td><?= $d->nome_participante ?></td>
                                    <td><?= $d->email ?></td>
                                    <td><?= $d->tipo_cargo ?></td>
                                    <td>
                                        <a href="participante/visualizar.php?id=<?= $d->id_participante ?>">
                                            <button type="button" class="btn btn-cyan btn-sm text-white">
                                                Visualizar
                                            </button>
                                        </a>
                                        <a href="participante/form.php?id=<?= $d->id_participante ?>">
                                            <button type="button" class="btn btn-secondary btn-sm text-white">
                                                Editar
                                            </button>
                                        </a>
                                        <button
                                                type="button"
                                                class="btn btn-danger btn-sm text-white btn-excluir"
                                                data-codigo="<?= $d->id_participante; ?>"
                                        >
                                            Excluir
                                        </button>
                                    </td>
                                </tr>

                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(function () {
        $(".table").DataTable();

        $('.btn-excluir').click(function () {
            var id = $(this).data('codigo');

            let obj = $(this);

            $.confirm({
                title: 'Aviso',
                content: 'Deseja excluir este registro?',
                type: 'red',
                icon: 'fa fa-warning',
                buttons: {
                    sim: {
                        text: 'Sim',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                url: 'pages/participante/index.php',
                                method: 'POST',
                                data: {
                                    acao: 'excluir',
                                    id
                                },
                                dataType: 'json',
                                success: function (data) {

                                    if (data.status) {
                                        $.alert('Sucesso: ' + data.msg);
                                    } else {
                                        $.alert('Error: ' + data.msg);
                                    }

                                    obj.parent().parent().remove();
                                }
                            })
                        }
                    },
                    nao: {
                        text: 'Não'
                    }
                }
            })
        });
    });
</script>
