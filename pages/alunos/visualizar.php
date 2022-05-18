<?php
include '../../config/includes.php';

$id = $_GET['id'];

$query = "SELECT * FROM aluno WHERE id_matricula = '{$id}'";
$result = mysqli_query($con, $query);
$d = mysqli_fetch_object($result);

?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Visualizar</h4>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="alunos/index.php">Alunos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Visualizar alunos
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="d-flex flex-row comment-row mt-0">

        <div class="comment-text w-100">
            <div class="py-2">
                <a href="aluno/form.php?id=<?= $id; ?>"></a>
                <button type="button" class="btn btn-cyan btn-sm text-white">
                    Editar
                </button>
                <button type="button" class="btn btn-danger btn-sm text-white">
                    Excluir
                </button>
            </div>
            <div class="d-flex flex-row align-items-center mb-3">
                <div class="me-3">
                    <img src="assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle">
                </div>
                <h2 class="font-medium">Nome do aluno</h2>
            </div>

            <div class="mb-2 d-block">
                <b>Turma: </b>Turma 01
            </div>
            <div class="mb-2 d-block">
                <b>CPF: </b>000.000.000-00
            </div>
            <div class="mb-2 d-block">
                <b>Responsavel: </b>Lorem ipsum
            </div>
            <div class="mb-2 d-block">
                <b>Contato: </b> (92) 99999-9999
            </div>
            <div class="mb-2 d-block">
                <b>E-Mail: </b> email@email.com
            </div>

        </div>
    </div>
</div>
