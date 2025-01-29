<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

//echo $c_sql_recurso;
include('../links2.php');
include('../conexao.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="panel panel-primary class">
        <div class="panel-heading text-center">
        <h4>Controle de Transporte da Secretaria Municipal de Saúde</h4>
        <h5>Lançamentos e consulta de Solicitação<h5>
        </div>
    </div>
    <div class="content">

        <div class="container -my5">
            <div class='alert alert-info' role='alert'>
                <div style="padding-left:15px;">
                    <img Align="left" src="\gop\images\escrita.png" alt="30" height="35">

                </div>
                <h5><?php $_SESSION['c_usuario'] ?>Clique em nova solicitação para abrir um novo lançamento ou realize uma pesquisa com o intervalo abaixo abaixo</h5>
            </div>
            <form method="post">
                <div style="padding-top:5px;padding-bottom:5px">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a class="btn btn btn-sm" href="\transporte\lancamentos\lancamentos_novo.php"><img src="\transporte\imagens\contato.png" alt="" width="25" height="25"> Nova Solicitação</a>
                            <button type="submit" name='btnpesquisa' id='btnpesquisa' class="btn btn btn-sm"><img src="\transporte\imagens\lupa.png" alt="" width="20" height="20"></span> Pesquisar</button>
                            <!--<a class="btn btn btn-sm" href="#"><img src="\gop\images\eraser.png" alt="" width="25" height="25"> Limpar pesquisa</a> -->
                            <a class="btn btn btn-sm" href="\transporte\menu.php"><img src="\transporte\imagens\saida.png" alt="" width="25" height="25"> Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-light class">
                    <div class="panel-heading text-center">
                        <h5>Intervalo da Consulta<h5>
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
                <br>

            </form>
        </div>
    </div>
   
</body>
</html>