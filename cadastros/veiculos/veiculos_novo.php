<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include('../../conexao.php');
// rotina de inclusão
$c_descricao = rtrim($_POST['c_descricao']);
$c_placa = $_POST['c_placa'];
$c_sql = "Insert into veiculo (descricao, placa) value ('$c_descricao','$c_placa')";

$result = $conection->query($c_sql);

if($result ==true)
{
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
  
    );

    echo json_encode($data);
} 

?>