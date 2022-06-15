<?php
include_once "../../../config/Config.php";
include_once "../../../config/DBConnect.php";


?>


<form id="form-adicionar-aluno" action="" method="post">

    <input type="hidden" name="acao" value="adicionar_aluno">

    <input type="hidden" name="turma_id" value="<?= $_GET['turma_id']; ?>">

    <div class="form-group mt-3">
        <label for="alu_id">Selecione um aluno <span class="text-danger">*</span></label>
        <select
                class="form-control"
                id="alu_id"
                name="alu_id"
                required
        >
            <option value=""></option>
            <?php
            $db = DBConnect::PDO();

            $query = "SELECT * FROM alunos a "
                . "WHERE NOT EXISTS (SELECT talu_id FROM turma_aluno ta WHERE ta.alu_id = a.alu_id);";

            $stm = $db->prepare($query);
            $stm->execute();

            $alunos = $stm->fetchAll(PDO::FETCH_OBJ);

            foreach ($alunos as $aluno) { ?>
                <option value="<?= $aluno->alu_id ?>"><?= $aluno->alu_nome ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="text-white btn btn-success">Salvar</button>
    </div>
</form>