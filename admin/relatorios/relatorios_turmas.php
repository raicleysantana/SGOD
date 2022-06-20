<?php
require_once "../../config/DBConnect.php";

$db = DBConnect::PDO();

$title = "Criar ocorrência";

require_once('../layout/_header.php');

include_once "../layout/navbar.php";
include_once "../layout/_sidebar.php";
include_once "../layout/breadcumbs.php";

$db = DBConnect::PDO();

$query_turmas = "SELECT o.turma_id,t.turma_numero as turma, COUNT(o.ocr_id) as qtd FROM ocorrencias o "
    . "LEFT JOIN turmas t ON t.turma_id = o.turma_id "
    . "GROUP BY o.tpo_id ORDER BY qtd DESC";

$stm = $db->prepare($query_turmas);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_OBJ);

$turmas = [];

foreach ($result as $row) {
    $turmas[] = "['{$row->turma}', {$row->qtd}]";
}

?>


<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Ocorrências por turmas</h2>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Ocorrências por turmas
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id="chart_div"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="<?= Config::$baseUrl ?>/js/loader.js"></script>

<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = google.visualization.arrayToDataTable([
            ['Turmas', 'Turmas'],
            <?= $turmas ? implode(", ", $turmas) : ''?>
        ]);

        var options = {
            title: 'Ocorrências por turmas',
            chartArea: {width: '50%'},
            hAxis: {
                format: '',
                title: 'Total Ocorrências',
                minValue: 0,

            },
            vAxis: {
                title: 'Turmas'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
</script>

<?php
include_once "../layout/_footer.php";
?>

