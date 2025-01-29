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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $c_tipo = $_POST['tipo'];
    $c_setor = $_POST['setor'];
    $c_fone1 = $_POST['fone1'];
    $c_fone2 = $_POST['fone2'];

    do {

        // faço a inclusão da tabela com sql
        $c_sql = "Insert into solicitantes (nome,telefone,telefone2,setor) Value ('$c_nome', '$c_fone1', '$c_fone2', '$c_setor')";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /transporte/cadastros/solicitantes/solicitantes_lista.php');
    } while (false);
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
                        <option></option>
                        <option>Administrativo</option>
                        <option>Unidade de Saúde</option>
                        <option>Oncologia</option>
                        <option>visita domiciliar</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row mb-6">
                <label class="col-md-2 form-label">Data</label>
                <div class="col-sm-2">
                    <input type="Date" class="form-control" name="data" id="data" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
                </div>
                <label class="col-md-1 form-label">Hora</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="hora" id="hora" required>
                </div>
            </div>
            <br>
            <div class="row mb-6">
                <label class="col-md-2 form-label">Destino</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="destino" id="destino" required>
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
                            echo "  
                          <option>$c_linha[nome]</option>
                        ";
                        }
                        ?>
                    </select>
                </div>
                <label class="col-sm-2 col-form-label">Motorista </label>
                <div class="col-sm-3">
                    <select class="form-select form-select-lg mb-3" id="motorista" name="motorista" required>
                        <option></option>
                        <?php
                        // select da tabela de motoristas
                        $c_sql = "SELECT motoristas.id, motoristas.nome FROM motoristas ORDER BY motoristas.nome";
                        $result = $conection->query($c_sql);
                        while ($c_linha = $result->fetch_assoc()) {
                            echo "  
                          <option>$c_linha[nome]</option>
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
                        <option></option>
                        <?php
                        // select da tabela de veiculos
                        $c_sql = "SELECT veiculo.id, veiculo.descricao FROM veiculo ORDER BY veiculo.descricao";
                        $result = $conection->query($c_sql);
                        while ($c_linha = $result->fetch_assoc()) {
                            echo "  
                          <option>$c_linha[descricao]</option>
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
                            echo "  
                          <option>$c_linha[nome]</option>
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
                    <textarea class="form-control" id="solicitacao" name="solicitacao" rows="6"></textarea>
                    </div>
              
            </div>

            <hr>
            <br>
            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/transporte/lancamentos/lancamentos.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>

        </form>
    </div>






    </form>




</body>

</html>