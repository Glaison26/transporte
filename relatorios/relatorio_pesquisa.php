<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("../conexao.php");
include("../links2.php");

date_default_timezone_set('America/Sao_Paulo');
$c_query = "";
// rotina para montagem do sql com a data selecionada
if ((isset($_POST["btnpesquisa"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // formatação de datas para o sql
    $_SESSION['periodo'] = ' de ' . date("d-m-Y", strtotime(str_replace('/', '-', $_POST['data1']))) . ' a ' . date("d-m-Y", strtotime(str_replace('/', '-', $_POST['data2'])));
    $d_data1 = $_POST['data1'];
    $d_data1 = date("Y-m-d", strtotime(str_replace('/', '-', $d_data1)));
    $d_data2 = $_POST['data2'];
    $d_data2 = date("Y-m-d", strtotime(str_replace('/', '-', $d_data2)));
       // data de lançamento
    $c_where = "(data>='$d_data1' and data<='$d_data2')";
    // montagem do sql para motoristas
    //
    $c_sql_motorista = "SELECT motoristas.id, motoristas.nome, COUNT(motoristas.id) AS total FROM lancamentos
    JOIN motoristas ON lancamentos.id_motorista=motoristas.id
    where $c_where
    GROUP BY motoristas.id order by total desc";
    // montagem de sql por veiculo
    $c_sql_veiculos = "SELECT veiculo.id, veiculo.descricao, COUNT(veiculo.id) AS total FROM lancamentos
    JOIN veiculo ON lancamentos.id_veiculo=veiculo.id
    where $c_where
    GROUP BY veiculo.id order by total desc";
    // guardo session para proxima pagina de tabelas
    $_SESSION['sql_motoristas'] = $c_sql_motorista;
    $_SESSION['sql_veiculos'] = $c_sql_veiculos;
    //echo $c_sql;
    echo "<script> window.open('/transporte/relatorios/bi.php?id=', '_blank');</script>";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>


<script>
    // função para verificas selct do tipo de solicitação e desebilita/ habilitar espaco fisico ou recurso
    function verifica(value) {
        var input_corretiva = document.getElementById("tipo_corretiva");
        var input_preventiva = document.getElementById("tipo_preventiva");

        if (value == 1) {
            input_corretiva.disabled = false;
            input_preventiva.disabled = true;
        } else if (value == 2) {
            input_corretiva.disabled = true;
            input_preventiva.disabled = false;
        } else if (value == 0) {
            input_corretiva.disabled = true;
            input_preventiva.disabled = true;
        }
    };
</script>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
        <h4>Controle de Transporte da Secretaria Municipal de Saúde</h4>
        <h5>Emissão de Relatório<h5>
        </div>
    </div>

    <div class="container  -my5">
        <div class='alert alert-info' role='alert'>
            <div style="padding-left:15px;">
                <img Align="left" src="\gop\images\escrita.png" alt="30" height="35">

            </div>
            <h5>Escolha o período para emissão do relatório</h5>
        </div>
        <form method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div style="padding-top:5px;padding-bottom:5px">

                        <button type="submit" name='btnpesquisa' id='btnpesquisa' class="btn btn btn-sm"><img src="\gop\images\printer.png" alt="" width="20" height="20"></span> Emitir</button>

                        <a class="btn btn btn-sm" href="\transporte\menu.php"><img src="\gop\images\saida.png" alt="" width="25" height="25"> Voltar</a>
                    </div>
                </div>
            </div>

            <div class="panel panel-light class">
                <div class="panel-heading text-center">
                    <h4>Periodo de emissão de relatório<h4>
                </div>
            </div>

            <div class="row mb-3">

                <label class="col-md-2 form-label">De</label>
                <div class="col-sm-3">
                    <input type="Date" class="form-control" name="data1" id="data1" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
                </div>
                <label class="col-md-1 form-label">até</label>
                <div class="col-sm-3">
                    <input type="Date" class="form-control" name="data2" id="data2" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
                </div>

            </div>

        </form>
    </div>

</body>

</html>