<?php
// emissão de mapa de cotação
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("../conexao.php");
include("../links2.php");
date_default_timezone_set('America/Sao_Paulo');
// por motoristas
$c_sql_motoristas = $_SESSION['sql_motoristas'];
$c_sql_veiculos = $_SESSION['sql_veiculos'];
// echo $c_sql_motoristas;
$result = $conection->query($c_sql_motoristas);
$result_grafico = $result;
//
// por veículos
$c_sql_veiculos = $_SESSION['sql_veiculos'];
// echo $c_sql_veiculos
$result2 = $conection->query($c_sql_veiculos);
$result_grafico2 = $result2;
// por solicitante
$c_sql_solicitantes = $_SESSION['sql_solicitantes'];
// echo $c_sql_solicitantes
$result3 = $conection->query($c_sql_solicitantes);
$result_grafico3 = $result3;
//
$c_periodo = $_SESSION['periodo'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="container">
        <h2 class="text-center">Relatório de Solicitações no Período</h2><br>

        <div class="panel panel-default">
            <div class="panel-heading text-center"><strong>Período :<?php echo $c_periodo ?> </strong></div>
            <hr>
            <h2 class="text-center">Relatório por Motoristas</h2><br>
            <table class="table table display table-bordered table-striped table-active tabocorrencias">
                <thead class="thead">
                    <tr>
                        <th scope="col">Motorista</th>
                        <th scope="col">No de Solicitações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i_chamados = 0;
                    while ($c_linha = $result->fetch_assoc()) {
                        $i_chamados += $c_linha['total'];
                        echo "
                            <tr class='info'>
                            <td>$c_linha[nome]</td>
                            <td>$c_linha[total]</td>
                          
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
            <div><?php echo "Total de Chamados : " . $i_chamados ?></div>
            <br><br>
            <!-------------------------- relatório por veiculo ------------------------>
            <h2 class="text-center">Relatório por Veículo</h2><br>
            <table class="table table display table-bordered table-striped table-active tabocorrencias">
                <thead class="thead">
                    <tr>
                        <th scope="col">Veículo</th>
                        <th scope="col">No de Solicitações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i_chamados = 0;
                    while ($c_linha = $result2->fetch_assoc()) {
                        $i_chamados += $c_linha['total'];
                        echo "
                            <tr class='info'>
                            <td>$c_linha[descricao]</td>
                            <td>$c_linha[total]</td>
                          
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
            <div><?php echo "Total de Chamados : " . $i_chamados ?></div>
            <!------------------------  relatório por solicitantes ------------------->
            <h2 class="text-center">Relatório por Solicitante</h2><br>
            <table class="table table display table-bordered table-striped table-active tabocorrencias">
                <thead class="thead">
                    <tr>
                        <th scope="col">Solicitante</th>
                        <th scope="col">No de Solicitações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i_chamados = 0;
                    while ($c_linha = $result3->fetch_assoc()) {
                        $i_chamados += $c_linha['total'];
                        echo "
                            <tr class='info'>
                            <td>$c_linha[nome]</td>
                            <td>$c_linha[total]</td>
                          
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
            <div><?php echo "Total de Chamados : " . $i_chamados ?></div>

        </div>
    </div>
    <hr>

    <!-- gráficos por motoristas -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script type="text/javascript">
        // gráfico por motorista
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Centros de Custo', 'chamados'],

                <?php
                $result_grafico = $conection->query($c_sql_motoristas);
                // percorre resultado da query para para montar gráfico
                while ($registro1 = $result_grafico->fetch_assoc()) {
                    $c_motorista = $registro1['nome'];
                    $c_qtd =  $registro1['total'];
                ?>['<?php echo $c_motorista ?>', <?php echo $c_qtd ?>],
                <?php } ?>
            ]);

            var options = {

            };

            var chart = new google.visualization.PieChart(document.getElementById('chart1'));

            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        // gráfico por veículo
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Centros de Custo', 'chamados'],

                <?php
                $result_grafico = $conection->query($c_sql_veiculos);
                // percorre resultado da query para para montar gráfico
                while ($registro2 = $result_grafico->fetch_assoc()) {
                    $c_veiculo = $registro2['descricao'];
                    $c_qtd =  $registro2['total'];
                ?>['<?php echo $c_veiculo ?>', <?php echo $c_qtd ?>],
                <?php } ?>
            ]);

            var options = {

            };

            var chart = new google.visualization.PieChart(document.getElementById('chart2'));

            chart.draw(data, options);
        }
    </script>
    <!-- gráficos por solicitantes -->
    <script type="text/javascript">
        // gráfico por solicitante
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Centros de Custo', 'chamados'],

                <?php
                $result_grafico = $conection->query($c_sql_solicitantes);
                // percorre resultado da query para para montar gráfico
                while ($registro3 = $result_grafico->fetch_assoc()) {
                    $c_solicitante = $registro3['nome'];
                    $c_qtd =  $registro3['total'];
                ?>['<?php echo $c_solicitante ?>', <?php echo $c_qtd ?>],
                <?php } ?>
            ]);

            var options = {

            };

            var chart = new google.visualization.PieChart(document.getElementById('chart3'));

            chart.draw(data, options);
        }
    </script>

    <div style="padding-left:400px;">
        <h3 class="text-left">Gráfico de Solicitações por Motoristas no Período</h3>
        <div id="chart1" style="width: 900px; height: 500px;"></div>
    </div>
    <br>
    <div style="padding-left:400px;">
        <h3 class="text-left">Gráfico de Solicitações por Veículos no Período</h3>
        <div id="chart2" style="width: 900px; height: 500px;"></div>
    </div>
    <br>
    <div style="padding-left:400px;">
        <h3 class="text-left">Gráfico de Solicitações por Solicitante no Período</h3>
        <div id="chart3" style="width: 900px; height: 500px;"></div>
    </div>

</body>

</html>