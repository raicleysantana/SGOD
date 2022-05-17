<?php
include_once '../../config/includes.php';
?>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>Turma</th>
            <th style="width: 25%">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $turma = $_GET['turma'];

        $query = "SELECT * FROM aluno a "
            . "LEFT JOIN turma t ON t.id_turma = a.id_turma "
            . "WHERE t.id_turma = '{$turma}'";

        $result = mysqli_query($con, $query);

        while ($d = mysqli_fetch_object($result)): ?>
            <tr>
                <td><?= $d->id_matricula; ?></td>
                <td><?= $d->nome_aluno; ?></td>
                <td><?= $d->numero_turma; ?></td>
                <td>
                    <a href="alunos/visualizar.php?id=<?= $d->id_matricula ?>">
                        <button type="button" class="btn btn-cyan btn-sm text-white">
                            Visualizar
                        </button>
                    </a>
                    <a href="alunos/form.php?id=<?= $d->id_matricula ?>">
                        <button type="button" class="btn btn-secondary btn-sm text-white">
                            Editar
                        </button>
                    </a>
                    <button
                            type="button"
                            class="btn btn-danger btn-sm text-white btn-excluir"
                            data-codigo="<?= $d->id_matricula; ?>"
                    >
                        Excluir
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>