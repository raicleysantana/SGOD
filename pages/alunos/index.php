<?php
include '../../config/includes.php';
?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Alunos</h4>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Alunos
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
                    <h5 class="card-title">Filtrar por turma</h5>

                    <div class="form-group row">
                        <label for="turma" class="col-sm-1 text-start control-label col-form-label">Turma</label>
                        <div class="col-sm-11">
                            <select id="turma" class="form-control">
                                <option value=""></option>
                                <?php
                                $query = "SELECT * FROM turma";
                                $result = mysqli_query($con, $query);
                                while ($d = mysqli_fetch_object($result)):?>
                                    <option value="<?= $d->id_turma ?>"><?= $d->numero_turma ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-success text-white filtrar">Filtrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between mb-3">
                        <h5 class="card-title">Alunos</h5>

                        <a href="alunos/form.php">
                            <button type="button" class="btn btn-success btn-sm text-white">
                                Novo Aluno
                            </button>
                        </a>
                    </div>

                    <div id="resultado-turma">

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(function () {
        $(".table").DataTable();

        <?php if($_GET['turma']): ?>
        loadAlunos('<?= $_GET['turma']?>')
        <?php endif; ?>

        $('.filtrar').click(function () {
            let turma = $('#turma').val();

            loadAlunos(turma);
        });

        function loadAlunos(turma) {
            $.ajax({
                url: 'pages/alunos/tabela.php',
                data: {turma},
                success: function (data) {
                    $("#resultado-turma").html(data);
                }
            })
        }
    });
</script>
