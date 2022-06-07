<?php

$title = "Painel administrativo";
require_once "../../../config/DBConnect.php";
require_once('../../layout/_header.php');

include_once "../../layout/navbar.php";
include_once "../../layout/_sidebar.php";
?>

<?php
$db = DBConnect::PDO();

$query = "SELECT * FROM alunos ORDER BY alu_nome";
$stm = $db->prepare($query)->execute();

?>
    <div>

        deodo
    </div>
<?php
include_once "../../layout/_footer.php";