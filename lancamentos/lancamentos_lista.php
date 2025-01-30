<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

//echo $c_sql_recurso;
include('../links.php');
include('../conexao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<!-- script da tabela de recursos -->
<script>
    $(document).ready(function() {
        $('.tablancamentos').DataTable({
            // 
            "iDisplayLength": -1,
            "order": [1, 'asc'],
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [7]
            }, {
                'aTargets': [0],
                "visible": false
            }],
            "oLanguage": {
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sLengthMenu": "_MENU_ resultados por página",
                "sInfoFiltered": " - filtrado de _MAX_ registros",
                "oPaginate": {
                    "spagingType": "full_number",
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",

                    "sLast": "Último"
                },
                "sSearch": "Pesquisar",
                "sLengthMenu": 'Mostrar <select>' +
                    '<option value="5">5</option>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> Registros'

            }

        });

    });
</script>

<script language="Javascript">
    function confirmacao(id) {
        var resposta = confirm("Deseja remover esse registro?");
        if (resposta == true) {
            window.location.href = "/transporte/lancamentos/lancamentos_excluir.php?id=" + id;
        }
    }
</script>



<body>

    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>Controle de Transporte da Secretaria Municipal de Saúde</h4>
                <h5>Lista de Solicitações realizadas<h5>
            </div>
        </div>
       
        <a class="btn btn-secondary btn-sm" href="/transporte/lancamentos/lancamentos.php"><span class="glyphicon glyphicon-off"></span> Voltar</a>

        <hr>
        <table class="table table display table-bordered tablancamentos">
            <thead class="thead">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Data</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Solicitante</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Motorista</th>
                    <th scope="col">Veículo</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // faço a Leitura da tabela com sql
                $c_sql = $_SESSION['sql'];
                $result = $conection->query($c_sql);
                // verifico se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }

                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {

                    echo "
            <tr class='info'>
            <td>$c_linha[id]</td>
            <td>$c_linha[data]</td>
            <td>$c_linha[hora]</td>
            <td>$c_linha[solicitante]</td>
            <td>$c_linha[destino]</td>
            <td>$c_linha[motorista]</td>
            <td>$c_linha[veiculo]</td>
            <td>$c_linha[paciente]</td>
            <td>
            <a class='btn btn-secondary btn-sm' href='/transporte/cadastros/solicitantes/solicitantes_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-pencil'></span> Editar</a>
            <a class='btn btn-danger btn-sm' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span> Excluir</a>
            </td>

            </tr>
            ";
                }
                ?>
            </tbody>
        </table>
    </div>



</body>

</html>