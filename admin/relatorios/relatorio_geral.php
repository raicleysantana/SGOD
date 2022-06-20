<?php
require_once "../../config/DBConnect.php";

$db = DBConnect::PDO();

$title = "Criar ocorrência";

require_once('../layout/_header.php');

include_once "../layout/navbar.php";
include_once "../layout/_sidebar.php";
include_once "../layout/breadcumbs.php";

$db = DBConnect::PDO();

$query_turmas = "SELECT CONCAT(t.turma_numero, ' - ',t.turma_periodo) AS turma, COUNT(o.ocr_id) AS qtd FROM ocorrencias o "
    . "LEFT JOIN turmas t ON t.turma_id = o.turma_id "
    . "GROUP BY o.turma_id ORDER BY t.turma_periodo, t.turma_numero;";

$stm = $db->prepare($query_turmas);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_OBJ);

$turmas = [];

foreach ($result as $row) {
    $turmas[] = "['{$row->turma}', {$row->qtd}]";
}

$query_ocorrencias = "SELECT COUNT(o.ocr_id) AS qtd, tpo.tpo_nome FROM ocorrencias o "
    . "LEFT JOIN tipos_ocorrencia tpo ON tpo.tpo_id = o.tpo_id "
    . "GROUP BY o.tpo_id ORDER BY tpo.tpo_nome;";

$stm1 = $db->prepare($query_ocorrencias);
$stm1->execute();
$result1 = $stm1->fetchAll(PDO::FETCH_OBJ);

$ocorrencias = [];

foreach ($result1 as $row1) {
    $ocorrencias[] = "['{$row1->tpo_nome}', {$row1->qtd}]";
}


$query_media_dia = 'SELECT COUNT(ocr_id) AS qtd, ocr_numero, ocr_dtcriacao, DATE_FORMAT(ocr_dtcriacao, "%H") as hora FROM `ocorrencias` '
    . 'GROUP BY DATE_FORMAT(ocr_dtcriacao, "%H")';

$stm2 = $db->prepare($query_media_dia);
$stm2->execute();
$result2 = $stm2->fetchAll(PDO::FETCH_OBJ);

$media_dia = [];

foreach ($result2 as $row2) {
    $media_dia[] = "[{v : [{$row2->hora}, 0, 0], f: '{$row2->hora}:00'}, {$row2->qtd}]";
}

#[{v: [8, 0, 0], f: '8 am'}, 1],
#[{v: [9, 0, 0], f: '9 am'}, 2],
?>


<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h2 class="page-title">Relatório geral</h2>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Config::$baseUrl ?>/admin">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Relatório geral
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
                    <div id="chart_picos"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div id="chart_div" class="w-100"></div>
                </div>
                <div class="col-lg-6">
                    <div id="chart_ocorrencias" class="w-100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= Config::$baseUrl ?>/js/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?= $turmas ? implode(', ', $turmas) : '';?>
        ]);

        var options = {
            'title': 'Relatório de ocorrencias por turma',
            'width': 600,
            'height': 500
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?= $ocorrencias ? implode(', ', $ocorrencias) : '';?>
        ]);

        var options = {
            'title': 'Tipos de ocorrencias',
            'width': 600,
            'height': 500
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_ocorrencias'));
        chart.draw(data, options);
    }
</script>

<script>
    function drawBasic() {

        var data = new google.visualization.DataTable();
        data.addColumn('timeofday', 'Time of Day');
        data.addColumn('number', 'Ocorrências');

        data.addRows([
            <?= $media_dia ? implode(', ', $media_dia) : ''?>
        ]);

        var options = {
            title: 'Média de de ocorrências por dia',
            trendlines: {
                0: {type: 'linear', lineWidth: 5, opacity: .3},
            },
            hAxis: {
                title: 'Hora do dia',
                format: 'H:mm',
                viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                }
            },
            vAxis: {
                title: 'Quantidade de ocorrências'
            }
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_picos'));

        chart.draw(data, options);
    }

    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);
</script>

<?php
include_once "../layout/_footer.php";
?>

