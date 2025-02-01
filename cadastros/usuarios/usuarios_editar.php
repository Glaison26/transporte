<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}


include('../../conexao.php');
include('../../links2.php');
include_once "../../lib_gop.php";


// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /transporte/cadastros/usuarios/usuarios_lista.php');
        exit;
    }

    $c_id = $_GET["id"];
    // leitura do cliente através de sql usando id passada
    $c_sql = "select * from usuarios where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /transporte/cadastro/usuarios/usuarios_lista.php');
        exit;
    }
    $c_nome = $registro["nome"];
    $c_login = $registro['login'];
    $c_senha = base64_decode($registro['senha']);  // senha descriptografia
    $c_ativo = $registro['ativo'];
    $c_tipo = $registro['tipo'];
    $c_senha2 = base64_decode($registro['senha']);  // senha descriptografia;

    if ($c_ativo == 'S') {
        $c_statusativo = 'checked';
    } else {
        $c_statusativo = '';
    }// 
    if ($registro['consulta'] == 'S') {
        $c_chkrelatorio = 'checked';
    } else {
        $c_chkrelatorio = 'N';
    }
    if ($registro['lancamentos'] == 'S') {
        $c_chklancamentos = 'checked';
    } else {
        $c_chklancamentos = 'N';
    }
    //
    if ($registro['cadastro'] == 'S') {
        $c_chkcadastros = 'checked';
    } else {
        $c_chkcadastros = 'N';
    }

} else {
    // metodo post para atualizar dados
    $c_id = $_POST["id"];
    $c_nome = $_POST["nome"];
    $c_login = $_POST['login'];
    $c_senha = $_POST['senha'];
    $c_senha2 = $_POST['senha2'];
    $c_tipo = $_POST['tipo'];


    if (!isset($_POST['chkativo'])) {
        $c_ativo = 'N';
    } else {
        $c_ativo = 'S';
    }
        //
        if (isset($_POST['chkcadastros'])) {
            $c_chkcadastros = 'S';
        } else {
            $c_chkcadastros = 'N';
        }
        //
        if (isset($_POST['chkrelatorios'])) {
            $c_chkrelatorios = 'S';
        } else {
            $c_chkrelatorios = 'N';
        }
    
        //
        if (isset($_POST['chklancamentos'])) {
            $c_chklancamentos = 'S';
        } else {
            $c_chklancamentos = 'N';
        }
    
    do {
        if (empty($c_nome) || empty($c_login) || empty($c_senha)) {
            $msg_erro = "Todos os Campos devem ser preenchidos!!";
            break;
        }
        // consiste se senha igual a confirmação
        if ($c_senha != $c_senha2) {
            $msg_erro = "Senha digitada diferente da senha de confirmação!!";
            break;
        }
        $i_tamsenha = strlen($c_senha);
        if (($i_tamsenha < 8) || ($i_tamsenha > 30)) {
            $msg_erro = "Campo Senha deve ter no mínimo 8 caracteres e no máximo 30 caracteres";

            break;
        }


        // consiste se senha tem pelo menos 1 caracter numérico
        if (filter_var($c_senha, FILTER_SANITIZE_NUMBER_INT) == '') {
            $msg_erro = "Campo Senha deve ter pelo menos (1) caracter numérico";
            break;
        }
        if (ctype_digit($c_senha)) {
            $msg_erro = "Campo Senha deve conter pelo menos uma letra do Alfabeto";
            break;
        }
        // grava dados no banco
        // criptografo senha
        $c_senha = base64_encode($c_senha);
        // faço a Leitura da tabela com sql
        $c_sql = "Update Usuarios" .
            " SET nome = '$c_nome', login ='$c_login', senha ='$c_senha', ativo='$c_ativo', tipo='$c_tipo'" .
            ", cadastro='$c_chkcadastros', consulta='$c_chkrelatorios',lancamentos='$c_chklancamentos'".
            " where id=$c_id";

        $result = $conection->query($c_sql);

        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /transporte/cadastros/usuarios/usuarios_lista.php');
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

</head>
<div class="container -my5">

    <body>
        <div style="padding-top:5px;">
            <div class="panel panel-primary class">
                <div class="panel-heading text-center">
                    <h4>Controle de Transporte da Secretaria Municipal de Saúde</h4>
                    <h5>Edição de dados do Usuário<h5>
                </div>
            </div>
        </div>
        <div class='alert alert-info' role='alert'>
            <div style="padding-left:15px;">
                <img Align="left" src="\gop\images\escrita.png" alt="30" height="35">

            </div>
            <h5>Campos com (*) são obrigatórios. A senha do usário deve conter pelo menos 1 letra do alfabeto, 1 caracter numérico, no mínimo 8 caracteres e no máximo 30 caracteres</h5>
        </div>

        <br>
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                <div style='padding-left:15px;'>
                    
                </div>
                <h4><img Align='left' src='\gop\images\aviso.png' alt='30' height='35'> $msg_erro</h4>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $c_id; ?>">
            <div class="row mb-3">
                <div class="form-check col-sm-3">
                    <label class="form-check-label col-form-label">Usuário Ativo</label>
                    <div class="col-sm-3">
                        <input class="form-check-input" type="checkbox" value="S" name="chkativo" id="chkativo"  <?php echo $c_statusativo ?>>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Login (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="40" class="form-control" name="login" value="<?php echo $c_login; ?>" required>
                </div>
            </div>
            <?php
            $op1 = '';
            $op2 = '';
            $op3 = '';
            if (($c_tipo == '') || ($c_tipo == 'Operador')) {
                $op1 = 'Selected';
            }
          
            if ($c_tipo == 'Administrador') {
                $op3 = 'Selected';
            }
            ?>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tipo de usuário (*)</label>
                <div class="col-sm-2">
                    <select class="form-select form-select-lg mb-3" id="tipo" name="tipo" value="<?php echo $c_tipo; ?>">
                        <option <?php echo $op1 ?>>Operador</option>
                        <option <?php echo $op3 ?>>Administrador</option>
                    </select>
                </div>
            </div>
            <p><h5>Controle de Acessos</h5></p>
            <div class="row mb-3">
                <div class="form-check col-sm-3">
                    <label class="form-check-label col-form-label">Acessa Cadastros</label>
                    <div class="col-sm-1">
                        <input class="form-check-input" type="checkbox" value="S" name="chkcadastros" id="chkcadastros"  <?php echo $c_chkcadastros ?>>
                    </div>
                </div>
                <div class="form-check col-sm-3">
                    <label class="form-check-label col-form-label">Acessa Relatórios</label>
                    <div class="col-sm-1">
                        <input class="form-check-input" type="checkbox" value="S" name="chkrelatorios" id="chkrelatorios"  <?php echo $c_chkrelatorio ?>>
                    </div>
                </div>
                <div class="form-check col-sm-3">
                    <label class="form-check-label col-form-label">Acessa Solicitações</label>
                    <div class="col-sm-1">
                        <input class="form-check-input" type="checkbox" value="S" name="chklancamentos" id="chklancamentos"  <?php echo $c_chklancamentos ?>>
                    </div>
                </div>
            </div>


            <hr>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Senha (*)</label>
                <div class="col-sm-2">
                    <input type="password" maxlength="32" class="form-control" name="senha" value="<?php echo $c_senha; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Senha Confirmação (*)</label>
                <div class="col-sm-2">
                    <input type="password" maxlength="32" class="form-control" name="senha2" value="<?php echo $c_senha2; ?>" required>
                </div>
            </div>

            <br>

            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/transporte/cadastros/usuarios/usuarios_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>

        </form>
</div>

</body>

</html>