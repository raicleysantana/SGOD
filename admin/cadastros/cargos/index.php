<?php
require_once "../../../config/DBConnect.php";

if ($_POST and $_POST['acao'] === 'excluir') {
    $id = $_POST['id'];

    $db = DBConnect::PDO();

    $stm = $db->prepare("DELETE FROM cargos WHERE cgo_id = '{$id}'");

    if ($stm->execute()) {
        echo json_encode(["status" => true, "msg" => "Excluído com sucesso"]);
    } else {
        echo json_encode(["status" => false, "msg" => "Error ao excluir"]);
    }

    exit();
}
$title = "Cargos";

require_once('../../layout/_header.php');
require_once("../../../config/Utils.php");

include_once "../../layout/navbar.php";
include_once "../../layout/_sidebar.php";
include_once "../../layout/breadcumbs.php";

?>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h2 class="page-title">Cargos</h2>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Cargos
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex flex-row justify-content-end mb-3">
                        <a
                                href="<?= Config::$baseUrl ?>/admin/cadastros/cargos/form.php"
                                class="btn btn-success text-white"><i class="fas fa-plus"></i> Novo</a>
                    </div>

                    <div class="row">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="60%">Nome</th>
                                <th scope="col" width="20%">Situação</th>
                                <th scope="col" width="20%">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $db = DBConnect::PDO();

                            $query = "SELECT * FROM cargos";
                            $stm = $db->prepare($query);
                            $stm->execute();

                            $cargos = $stm->fetchAll(PDO::FETCH_OBJ);

                            foreach ($cargos as $cargo):
                                ?>
                                <tr id="cargo-<?= $cargo->cgo_id ?>">
                                    <th scope="row"><?= $cargo->cgo_id ?></th>
                                    <td><?= $cargo->cgo_nome ?></td>
                                    <td><?= Utils::situacao($cargo->cgo_situacao) ?></td>
                                    <td>
                                        <a
                                                href="<?= Config::$baseUrl ?>/admin/cadastros/cargos/visualizar.php?id=<?= $cargo->cgo_id ?>"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title=""
                                                data-bs-original-title="Visualizar"
                                        >
                                            <i class="mdi mdi-eye me-2"></i>
                                        </a>
                                        <a
                                                href="<?= Config::$baseUrl ?>/admin/cadastros/cargos/form.php?id=<?= $cargo->cgo_id ?>"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title=""
                                                data-bs-original-title="Alterar"
                                        >
                                            <i class="mdi mdi-grease-pencil me-2 text-warning"></i>
                                        </a>

                                        <a
                                                class="excluir"
                                                href="#"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title=""
                                                data-id="<?= $cargo->cgo_id; ?>"
                                                data-bs-original-title="Excluir"
                                        >
                                            <i class="fas fa-trash-alt me-2 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".excluir").click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.alert({
                    title: "Aviso",
                    content: "Tem certeza que deseja excluir?",
                    buttons: {
                        sim: {
                            text: 'sim',
                            action: function () {
                                $.ajax({
                                    url: "index.php",
                                    method: "post",
                                    data: {id, acao: "excluir"},
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.status) {
                                            $.alert({
                                                title: 'Sucesso',
                                                content: response.msg
                                            });

                                            $(`#cargo-${id}`).remove();
                                        } else {
                                            $.alert({
                                                title: 'Error',
                                                content: response.msg
                                            });
                                        }
                                    }
                                })
                            }
                        },
                        nao: {
                            text: 'Não',
                            action: () => {
                            },
                        }
                    }
                })
            })
        })
    </script>
<?php
include_once "../../layout/_footer.php";