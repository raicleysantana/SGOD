<?php

function alertas()
{

//session_start();

    if (!empty($_SESSION['msg_sucesso'])) { ?>
        <div class="alert alert-success mt-2 m-3" role="alert">
            <?= $_SESSION['msg_sucesso'] ?>
        </div>
    <?php } elseif (!empty($_SESSION['msg_error'])) { ?>
        <div class="alert alert-danger mt-2 mx-3" role="alert">
            <?= $_SESSION['msg_error'] ?>
        </div>
    <?php }

    unset($_SESSION['msg_sucesso'], $_SESSION['msg_error']);
} ?>
