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
                    <h5 class="card-title">Alunos</h5>
                    <div class="table-responsive">
                        <table
                                id="zero_config"
                                class="table table-striped table-bordered"
                        >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Turma</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>1</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
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
