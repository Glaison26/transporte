<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

if (!isset($_GET["id"])) {
    header('location: /transporte/cadastros/motoristas/motoristas_lista.php');
    exit;
}
$c_id = "";
$c_id = $_GET["id"];
// conexão dom o banco de dados
include("../../conexao.php");
include("../../links2.php");
include('../../cabec_exclusao.php');
// verico se elxistem lançamentos com o motorista no cadastro
$c_sql_conta = "select count(*) nregistros from lancamentos where id_motorista=$c_id";
$result = $conection->query($c_sql_conta);
$registro = $result->fetch_assoc();
// Exclusão do registro
if ($registro['nregistros'] == 0) {
    $c_sql = "delete from motoristas where id=$c_id";
    $result = $conection->query($c_sql);
    header('location: /transporte/cadastros/motoristas/motoristas_lista.php');
} else {
    echo "<script>alert('Não é possivel excluir registro!')</script>";
    echo "<div class='container-fluid'>
    <a class='btn btn-primary' href='/transporte/cadastros/motoristas/motoristas_lista.php'><span class='glyphicon glyphicon-off'></span> Voltar a Lista</a>
    </div>";
}