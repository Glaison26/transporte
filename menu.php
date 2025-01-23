 <?php
    // controle de acesso ao formulário
    session_start();
    if (!isset($_SESSION['newsession'])) {
        die('Acesso não autorizado!!!');
    }
    include('conexao.php');

    date_default_timezone_set('America/Sao_Paulo');
    $agora = date('d/m/Y H:i');
    $c_data = date('Y-m-d');
    //
    $_SESSION['voltadiretriz'] = 'N';
    $_SESSION['consulta_solicitacao'] = "";
    $_SESSION['consulta_ordem'] = "";
    // verifico numero de solicitações em aberto
    $c_sql = "select COUNT(*) AS aberta_solicitacao FROM solicitacao WHERE STATUS = 'A'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $c_solicitacao_aberta = $registro['aberta_solicitacao'];
    $c_ordens_sla = 0;
    //verifoco numero de preventivas a serem geradas
    $c_sql = "select COUNT(*) AS preventivas FROM preventivas WHERE data_prox_realizacao<='$c_data'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $c_preventivas = $registro['preventivas'];
    // verifco Ordens de serviço com o SLA em atraso
    $c_sql = "select COUNT(*) AS sla FROM ordens WHERE data_previsao <= '$c_data' AND ordens.`status`='A'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $c_ordens_sla = $registro['sla'];
    // verifico ordens de serviço que encontran-se em aberto
    $c_sql = "select COUNT(*) AS abertas FROM ordens WHERE  ordens.`status`='A'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();
    $c_ordens_abertas = $registro['abertas'];


    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>GOP - Gestão Operacional</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" type="imagex/png" href="./imagens/img_gop.ico">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
     <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
     <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
     <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

     <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
     <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
     <script src="js/jquery.min.js"></script>
     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 </head>

 <div class="content">
     <main>

                 <div class="panel default class">
                     <div class="alert alert-success">

                         <strong>Login efetuado! - </strong>Bem vindo <?php echo ' ' . $_SESSION['c_usuario'] . ' - ' . $agora . ' '; ?>
                         <label for="usuario"></label>
                     </div>
                 </div>
                 <br>
                 <div class="content">
                     <?php
                        if ($_SESSION['tipo'] <> 'Solicitante') {
                            require('cards_menu.php');
                        }
                        ?>
                 </div>

         </div>
         </body>

         <div style="padding-bottom:15px;">
             <footer>
                 <div style="padding-left :10px;">
                     <p>
                     <h4>GOP - Gestão Operacional - Todos os direitos reservados</h4>
                     </p>
                 </div>
             </footer>
         </div>

     </main>
 </div>




 </html>



 <style>
     /* Add a black background color to the top navigation */
     .topnav {
         background-color: #4682B4;
         overflow: hidden;
     }

     /* Style the links inside the navigation bar */
     .topnav a {
         float: left;
         color: #f2f2f2;
         text-align: center;
         padding: 14px 16px;
         text-decoration: none;
         font-size: 17px;
     }

     /* Change the color of links on hover */
     .topnav a:hover {
         background-color: #4682B4;
         color: black;
     }

     /* Add a color to the active/current link */
     .topnav a.active {
         background-color: #4682B4;
         color: white;
     }
 </style>


 <!-- rodape do menu -->
 <style>
     html,
     body {
         min-height: 100%;
     }

     body {
         padding: 0;
         margin: 0;
     }

     footer {
         position: fixed;
         bottom: 0;
         background-color: #4682B4;
         color: #FFF;
         width: 100%;
         height: 45px;
         text-align: left;
         line-height: 70px;
     }
 </style>