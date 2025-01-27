<?php
// controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../../conexao.php");
include("../../links2.php");
include_once "../../lib_gop.php";

$c_nome = '';
$c_fone1 = '';
$c_fone2 = '';
$c_endereco = '';
$c_bairro = '';
$c_cep = '';
$c_cnh = '';
$c_email = '';

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $c_nome = $_POST['nome'];
    $c_fone1 = $_POST['fone1'];
    $c_fone2 = $_POST['fone2'];
    $c_endereco = $_POST['endereco'];
    $c_bairro = $_POST['bairro'];
    $c_cep = $_POST['cep'];
    $c_cnh = $_POST['cnh'];
    $c_email = $_POST['email'];

    do {

        // faço a inclusão da tabela com sql
        $c_sql = "Insert into motoristas (nome,fone1,fone2,endereco,bairro, cep,cnh,email) Value ('$c_nome', '$c_fone1', '$c_fone2', 
        '$c_endereco', '$c_bairro', '$c_cep', '$c_cnh', '$c_email')";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /transporte/cadastros/motoristas/motoristas_lista.php');
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <script>
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g, '')
            value = value.replace(/(\d{2})(\d)/, "($1) $2")
            value = value.replace(/(\d)(\d{4})$/, "$1-$2")
            return value
        }
    </script>

</head>

<body>
    <div class="container  -my5">
        <div style="padding-top:5px;">
            <div class="panel panel-primary class">

                <div class="panel-heading text-center">
                    <h4>Controle de Transporte da Secretaria Municipal de Saúde</h4>
                    <h5>Entrada de Novo Motorista<h5>
                </div>
            </div>
        </div>

        <div class='alert alert-info' role='alert'>
            <div style="padding-left:15px;">
                <img Align="left" src="\gop\images\escrita.png" alt="30" height="35">

            </div>
            <h5>Campos com (*) são obrigatórios</h5>
        </div>

        <br>
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                <div style='padding-left:15px;'>
                    <h5><img Align='left' src='\gop\images\aviso.png' alt='30' height='35'> $msg_erro</h5>
                </div>
                
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="200" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="200" class="form-control" name="endereco" value="<?php echo $c_endereco; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Bairro</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="100" class="form-control" name="bairro" value="<?php echo $c_bairro; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">CEP</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="15" class="form-control" name="cep" value="<?php echo $c_cep; ?>">
                </div>
                <label class="col-sm-2 col-form-label">No. CNH</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="15" class="form-control" name="cnh" value="<?php echo $c_cnh; ?>">
                </div>
            </div>
            <div class="row mb-3">

            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Fone I (*)</label>
                <div class="col-sm-2">
                    <input type="tel" onkeyup="handlePhone(event)" maxlength="20" id="fone1" class="form-control" name="fone1" value="<?php echo $c_fone1; ?>" required>
                </div>
                <label class="col-sm-2 col-form-label">Fone II</label>
                <div class="col-sm-2">
                    <input type="tel" onkeyup="handlePhone(event)" maxlength="20" id="fone2" class="form-control" name="fone2" value="<?php echo $c_fone2; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">e-mail</label>
                <div class="col-sm-6">
                    <input type="email" maxlength="200" class="form-control" name="email" value="<?php echo $c_email; ?>">
                </div>
            </div>



            <?php
            if (!empty($msg_gravou)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                             <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$msg_gravou</strong>
                                   
                             </div>
                        </div>     
                    </div>    
                ";
            }
            ?>
            <hr>
            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/transporte/cadastros/motoristas/motoristas_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>
        </form>
    </div>

</body>

</html>