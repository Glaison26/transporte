<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}


include('../conexao.php');
include('../links2.php');
include_once "../lib_gop.php";
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

            <label class="col-sm-3 col-form-label">Ocorrencia </label>
            <div class="col-sm-7">

                <select onchange="verifica(value)" class="form-select form-select-lg mb-3" id="ocorrencia" name="ocorrencia" value="<?php echo $c_ocorrencia ?>" required>

                    <option></option>
                    <?php
                    // select da tabela de ocorrencia
                    $c_sql_setor = "SELECT ocorrencias.id, ocorrencias.descricao FROM ocorrencias ORDER BY ocorrencias.descricao";
                    $result_setor = $conection->query($c_sql_setor);
                    while ($c_linha = $result_setor->fetch_assoc()) {
                        if (!empty($_SESSION['valor_ocorrencia'])) {
                            if ($_SESSION['valor_ocorrencia'] == $c_linha['descricao'])
                                $op = 'selected';
                            else
                                $op = "";
                        }
                        echo "  
          <option $op>$c_linha[descricao]</option>
        ";
                    }
                    ?>
                </select>

            </div>
    </div>


    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Tipo de Solicitação</label>
        <div class="col-sm-2">
            <select class="form-select form-select-lg mb-3" id="tipo" name="tipo" value="<?php echo $c_tipo; ?>" required>
                <option></option>
                <option>Programada</option>
                <option>Urgência</option>

            </select>
        </div>
        <label class="col-sm-2 col-form-label">Setor </label>
        <div class="col-sm-3">
            <select class="form-select form-select-lg mb-3" id="setor" name="setor" required>
                <option></option>
                <?php
                // select da tabela de setores
                $c_sql_setor = "SELECT setores.id, setores.descricao FROM setores ORDER BY setores.descricao";
                $result_setor = $conection->query($c_sql_setor);
                while ($c_linha = $result_setor->fetch_assoc()) {
                    echo "  
                          <option>$c_linha[descricao]</option>
                        ";
                }
                ?>
            </select>
        </div>

    </div>
    <div style="padding-top:5px;">

        <div class="row mb-7">
            <label class="col-sm-3 col-form-label">Descrição </label>
            <div class="col-sm-7">
                <textarea class="form-control" id="solicitacao" name="solicitacao" rows="10"><?php echo $c_solicitacao; ?></textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="row mb-3">
        <div class="offset-sm-0 col-sm-3">
            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Finalizar</button>
            <a class='btn btn' href='/gop/solicitacao/solicitacao_nova.php'><img src="\gop\images\saida.png" alt="" width="25" height="25"> Voltar</a>
        </div>
    </div>
    </form>
    </div>



</body>

</html>