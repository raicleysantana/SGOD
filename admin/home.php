<?php
include_once "../config/DBConnect.php";

$query_aluno = "SELECT COUNT(alu_id) FROM alunos";
$query_turma = "SELECT COUNT(turma_id) FROM turmas";
$query_part = "SELECT COUNT(part_id) FROM participantes";
$query_ocorrencia = "SELECT COUNT(ocr_id) FROM ocorrencias";
$query = "SELECT ({$query_aluno}) AS qtd_alunos, ({$query_aluno}) AS qtd_turmas, ({$query_part}) AS qtd_parts, ({$query_ocorrencia}) AS qtd_ocorrencias";

$db = DBConnect::PDO();
$stm = $db->prepare($query);
$stm->execute();

$dados = $stm->fetch(PDO::FETCH_OBJ);

?>


<div class="container-fluid">
    <div class="col-lg-12 mb-4">
        <h3 class="text-center">
            SISTEMA DE GESTÃO DE OCORRÊNCIAS DISCIPLINARES PEDAGOGICAS
        </h3>
    </div>

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3 col-6 mt-3">
                <div class="bg-dark p-10 text-white text-center">
                    <i class="mdi mdi-account-multiple fs-3 mb-1 font-16"></i>
                    <h5 class="mb-0 mt-1"><?= $dados->qtd_alunos ?></h5>
                    <small class="font-light">Alunos</small>
                </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
                <div class="bg-dark p-10 text-white text-center">
                    <i class="mdi mdi-account-multiple fs-3 mb-1 font-16"></i>
                    <h5 class="mb-0 mt-1"><?= $dados->qtd_turmas ?></h5>
                    <small class="font-light">Turmas</small>
                </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
                <div class="bg-dark p-10 text-white text-center">
                    <i class="mdi mdi-account fs-3 font-16"></i>
                    <h5 class="mb-0 mt-1"><?= $dados->qtd_parts ?></h5>
                    <small class="font-light">Participantes</small>
                </div>
            </div>

            <div class="col-lg-3 col-6 mt-3">
                <div class="bg-dark p-10 text-white text-center">
                    <i class="mdi mdi-file-document fs-3 mb-1 font-16"></i>
                    <h5 class="mb-0 mt-1"><?= $dados->qtd_ocorrencias ?></h5>
                    <small class="font-light">Ocorrências</small>
                </div>
            </div>


        </div>
    </div>
</div>