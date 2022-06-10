<?php

class Componentes
{
    public static function alertas()
    {
        if (!empty($_SESSION['msg_sucesso'])) { ?>
            <div class="alert alert-success mx-3" role="alert">
                <?= $_SESSION['msg_sucesso'] ?>
            </div>
        <?php } elseif (!empty($_SESSION['msg_error'])) { ?>
            <div class="alert alert-danger mx-3" role="alert">
                <?= $_SESSION['msg_error'] ?>
            </div>
<?php }
        unset($_SESSION['msg_sucesso'], $_SESSION['msg_error']);
    }
} ?>