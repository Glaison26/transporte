<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

//echo $c_sql_recurso;
include('../../links.php');
include('../../conexao.php');
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
        $('.tabsolicitantes').DataTable({
            // 
            "iDisplayLength": -1,
            "order": [1, 'asc'],
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [4]
            }, {
                'aTargets': [0],
                "visible": true
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



<body>

    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>Gestão de Transportes</h4>
                <h5>Cadastro de solicitantes<h5>
            </div>
        </div>
        <div class="container-fluid">

            <a class="btn btn-success btn-sm" href="/gop/cadastros/setores/setores_novo.php"><span class="glyphicon glyphicon-plus"></span> Incluir</a>
            <a class="btn btn-secondary btn-sm" href="/gop/menu.php"><span class="glyphicon glyphicon-off"></span> Voltar</a>

            <hr>
            <table class="table table display table-bordered tabsolicitantes">
                <thead class="thead">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Fone I</th>
                        <th scope="col">Fone II</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // faço a Leitura da tabela com sql
                    $c_sql = "SELECT solicitantes.id, solicitantes.nome, solicitantes.telefone, solicitantes.telefone2, solicitantes.setor
                            FROM solicitantes ORDER BY solicitantes.nome";
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
            <td>$c_linha[nome]</td>
            <td>$c_linha[setor]</td>
            <td>$c_linha[telefone]</td>
            <td>$c_linha[telefone2]</td>
            <td>
            <a class='btn btn-secondary btn-sm' href='/gop/cadastros/setores/setores_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-pencil'></span> Editar</a>
            <a class='btn btn-danger btn-sm' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span> Excluir</a>
            </td>

            </tr>
            ";
                    }
                    ?>


                </tbody>
            </table>
        </div>

    </div>

</body>

</html>