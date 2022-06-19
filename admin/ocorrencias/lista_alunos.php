<?php
require_once "../../config/DBConnect.php";
require_once "../../config/Config.php";
require_once "../../config/Utils.php";

$turma_id = $_POST['turma_id'];

$db = DBConnect::PDO();

$query = "SELECT * FROM turma_aluno ta "
    . "LEFT JOIN alunos a ON a.alu_id = ta.alu_id "
    . "WHERE ta.turma_id = '{$turma_id}'";

$stm = $db->prepare($query);
$stm->execute();

$result = $stm->fetchAll(PDO::FETCH_OBJ);
?>
<style>
    .lista-alunos td, .lista-alunos th {
        padding: 8px;
    }
</style>
<ul style="list-style: none">
    <?php foreach ($result as $turma_aluno): ?>
        <li>
            <div class="form-check mb-0">
                <input
                        class="form-check-input"
                        type="checkbox"
                        value="<?= $turma_aluno->talu_id ?>"
                        id="check_<?= $turma_aluno->talu_id ?>"
                >
                <label class="form-check-label mb-0" for="check_<?= $turma_aluno->talu_id ?>">
                    <?= $turma_aluno->alu_nome; ?>
                </label>
            </div>
        </li>
    <?php endforeach; ?>

</ul>

