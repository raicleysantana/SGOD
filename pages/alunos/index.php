<?php
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
                            <select class="form-control">
                                <option value=""></option>
                                <option value="">Turma 01</option>
                                <option value="">Turma 02</option>
                                <option value="">Turma 03</option>
                                <option value="">Turma 04</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success text-white">Filtrar</button>
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

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Turma</th>
                                <th style="width: 25%">Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>1</td>
                                <td>Raicley Santana da silva</td>
                                <td>037.821.052-14</td>
                                <td>27</td>
                                <td>
                                    <a href="#">
                                        <button type="button" class="btn btn-cyan btn-sm text-white">
                                            Visualizar
                                        </button>
                                    </a>
                                    <a href="alunos/form.php">
                                        <button type="button" class="btn btn-warning btn-sm text-white">
                                            Editar
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm text-white">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
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
    });
</script>
