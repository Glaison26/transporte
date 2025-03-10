<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}


include('../conexao.php');
include('../links2.php');
include_once "../lib_gop.php";

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";
$c_id = $_GET["id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $c_tipo = $_POST['tipo'];
    $c_motorista = $_POST['motorista'];
    // localizo id do motorias via sql
    $c_sql = "select id from motoristas where nome='$c_motorista'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $i_motorista = $registro['id'];
    $c_solicitante = $_POST['solicitante'];
    // localizo id do solicitante via sql
    $c_sql = "select id from solicitantes where nome='$c_solicitante'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $i_solicitante = $registro['id'];
    $c_paciente = $_POST['paciente'];
    // localizo id do paciente via sql
    $c_sql = "select id from paciente where nome='$c_paciente'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $i_paciente = $registro['id'];
    $c_destino = $_POST['destino'];
    $c_justificativa = $_POST['justificativa'];
    $c_veiculo = $_POST['veiculo'];
    // localizo id do paciente via sql
    $c_sql = "select id from veiculo where descricao='$c_veiculo'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $i_veiculo = $registro['id'];
    $c_data = $_POST['data'];
    $c_hora = $_POST['hora'];

    do {

        // faço a alteracao da tabela com sql
        $c_sql = "update lancamentos set tipo='$c_tipo', id_motorista='$i_motorista', id_solicitante='$i_solicitante',
        id_paciente='$i_paciente', id_veiculo='$i_veiculo', data='$c_data', hora='$c_hora', justificativa='$c_justificativa', destino='$c_destino' where id='$c_id'";
     
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /transporte/lancamentos/lancamentos_lista.php');
    } while (false);
} else // seleciona os dados para o formulário
{

    if (!isset($_GET["id"])) {
        header('location: /transporte/lancamentos/lancamentos_lista.php');
        exit;
    }
    $c_id = $_GET["id"];
    // leitura do cliente através de sql usando id passada
    $c_sql = "select * from lancamentos where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /transporte/lancamentos/lancamentos_lista.php');
        exit;
    }
    $c_tipo = $registro['tipo'];
    $c_motorista = $registro['id_motorista'];
    $c_solicitante = $registro['id_solicitante'];
    $c_paciente = $registro['id_paciente'];
    $c_destino = $registro['destino'];
    $c_justificativa = $registro['justificativa'];
    $c_veiculo = $registro['id_veiculo'];
    $c_data = $registro['data'];
    $c_hora = $registro['hora'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>


    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>Controle de Transporte da Secretaria Municipal de Saúde</h4>
            <h5>Lançamento Solicitação<h5>
        </div>
    </div>

    <div class="container -my5">
        <div class='alert alert-info' role='alert'>
            <div style="padding-left:15px;">
                <img Align="left" src="\transporte\imagens\escrita.png" alt="30" height="35">
            </div>
            <h5>Digite as informações da solicitação e clique em finalizar para gravar a solicitação. Todos os Campos com (*) são obrigatórios</h5>
        </div>

        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                
                <h3><img Align='left' src='\gop\images\aviso.png' alt='30' height='35'><span>&nbsp;&nbsp;&nbsp; $msg_erro</span></h3>
            </div>
            ";
        }
        ?>
        <form method="post" name="frm_solicitacao">
            <div class="row mb-6">
                <label class="col-sm-2 col-form-label">Tipo de Solicitação</label>
                <div class="col-sm-3">
                    <select class="form-select form-select-lg mb-3" id="tipo" name="tipo" value="<?php echo $c_tipo; ?>" required>

                        <option <?= ($c_tipo == 'Administrativo') ? 'selected' : '' ?>>Administrativo</option>
                        <option <?= ($c_tipo == 'Unidade de Saúde') ? 'selected' : '' ?>>Unidade de Saúde</option>
                        <option <?= ($c_tipo == 'Oncologia') ? 'selected' : '' ?>>Oncologia</option>
                        <option <?= ($c_tipo == 'Visita domiciliar') ? 'selected' : '' ?>>Visita domiciliar</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row mb-6">
                <label class="col-md-2 form-label">Data</label>
                <div class="col-sm-2">
                    <input type="Date" class="form-control" name="data" id="data" value='<?php echo $c_data; ?>' onkeypress="mascaraData(this)">
                </div>
                <label class="col-md-1 form-label">Hora</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="hora" id="hora" value='<?php echo $c_hora; ?>' required>
                </div>
            </div>
            <br>
            <div class="row mb-6">
                <label class="col-md-2 form-label">Destino</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="destino" id="destino" value='<?php echo $c_destino; ?>' required>
                </div>
                <br>
            </div>
            <br>

            <div class="row mb-6">
                <label class="col-sm-2 col-form-label">Solicitante </label>
                <div class="col-sm-3">
                    <select class="form-select form-select-lg mb-3" id="solicitante" name="solicitante" required>
                        <option></option>
                        <?php
                        // select da tabela de solicitantes
                        $c_sql = "SELECT solicitantes.id, solicitantes.nome FROM solicitantes ORDER BY solicitantes.nome";
                        $result = $conection->query($c_sql);
                        while ($c_linha = $result->fetch_assoc()) {
                            $c_op = '';
                            if ($c_linha['id'] == $c_solicitante)
                                $c_op = 'selected';
                            echo "  
                          <option $c_op>$c_linha[nome]</option>
                        ";
                        }
                        ?>
                    </select>
                </div>
                <label class="col-sm-2 col-form-label">Motorista </label>
                <div class="col-sm-3">
                    <select class="form-select form-select-lg mb-3" id="motorista" name="motorista" required>

                        <?php
                        // select da tabela de motoristas
                        $c_sql = "SELECT motoristas.id, motoristas.nome FROM motoristas ORDER BY motoristas.nome";
                        $result = $conection->query($c_sql);
                        while ($c_linha = $result->fetch_assoc()) {
                            $c_op = '';
                            if ($c_linha['id'] == $c_motorista)
                                $c_op = 'selected';
                            echo "  
                          <option $c_op>$c_linha[nome]</option>
                        ";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-sm-2 col-form-label">Veículo </label>
                <div class="col-sm-3">
                    <select class="form-select form-select-lg mb-3" id="veiculo" name="veiculo" required>

                        <?php
                        // select da tabela de veiculos
                        $c_sql = "SELECT veiculo.id, veiculo.descricao FROM veiculo ORDER BY veiculo.descricao";
                        $result = $conection->query($c_sql);
                        while ($c_linha = $result->fetch_assoc()) {
                            $c_op = '';
                            if ($c_linha['id'] == $c_veiculo)
                                $c_op = 'selected';
                            echo "  
                          <option $c_op>$c_linha[descricao]</option>
                        ";
                        }
                        ?>
                    </select>
                </div>
                <label class="col-sm-2 col-form-label">Paciente </label>
                <div class="col-sm-3">
                    <select class="form-select form-select-lg mb-3" id="paciente" name="paciente" required>
                        <option></option>
                        <?php
                        // select da tabela de pacientes
                        $c_sql = "SELECT paciente.id, paciente.nome FROM paciente ORDER BY paciente.nome";
                        $result = $conection->query($c_sql);
                        while ($c_linha = $result->fetch_assoc()) {
                            $c_op = '';
                            if ($c_linha['id'] == $c_paciente)
                                $c_op = 'selected';
                            echo "  
                          <option $c_op>$c_linha[nome]</option>
                        ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row mb-3">

                <label class="col-sm-2 col-form-label">Justificativa</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="justificativa" name="justificativa" rows="6"><?php echo $c_justificativa; ?></textarea>
                </div>

            </div>

            <hr>
            <br>
            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/transporte/lancamentos/lancamentos_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>

        </form>
    </div>






    </form>




</body>

</html>