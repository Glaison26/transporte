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

    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>Gestão de Transporte</title>
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

         <div class="container-fluid">

             <body class="sb-nav-fixed">

                 <div style="padding-top :2px;">
                     <div class="panel">
                         <div class="panel-heading text-center text-primary">
                             <br><br>
                             <h1><img Align="left" style="width:180px" class="img-responsive" src="\transporte\imagens\sabara.jpeg">
                                 <strong>Controle de Transporte da Secretaria Municipal de Saúde</strong>
                             </h1>
                         </div>
                     </div>
                 </div>
                <br><br>
                 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-blue ftco-navbar-light" id="ftco-navbar">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="fa fa-bars">Menu</span>
                     </button>
                     <div class="collapse navbar-collapse" id="ftco-nav">
                         <div class="navbar-header">

                             <div style="padding-left :10px;">
                                 <ul class="navbar-nav mr-auto">
                                     <li class='nav-item'><a href='/transporte/lancamentos/lancamentos.php' class='nav-link'><img src='\transporte\imagens\notas.png' alt='25' width='25' height='25'> Solicitações</a></li>
                                 </ul>
                             </div>
                         </div>
                         <div style="padding-left :10px;">
                             <ul class="navbar-nav mr-auto">
                                 <li class='nav-item dropdown'>
                                     <!-- Opções de cadastro do menu -->
                                     <a class='nav-link dropdown-toggle' href='#' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='\transporte\imagens\cadastro.png' alt='25' width='25' height='25'> Cadastros</a>
                                     <div class='dropdown-menu' aria-labelledby='dropdown01'>
                                         <a class='dropdown-item' href='/transporte/cadastros/solicitantes/solicitantes_lista.php'><img src='\transporte\imagens\solicitante.png' alt='25' width='25' height='25'> Solicitantes de Transporte...</a>
                                         <a class='dropdown-item' href='/transporte/cadastros/motoristas/motoristas_lista.php'><img src='\transporte\imagens\condutor.png' alt='25' width='25' height='25'> Motoristas da Prefeitura...</a>
                                         <a class='dropdown-item' href='/transporte/cadastros/veiculos/veiculos_lista.php'><img src='\transporte\imagens\carro.png' alt='25' width='25' height='25'> Veículos Disponíveis...</a>
                                         <a class='dropdown-item' href='/transporte/cadastros/pacientes/pacientes_lista.php'><img src='\transporte\imagens\pacientes.png' alt='25' width='25' height='25'> Pacientes Atendidos...</a>
                                         <a class='dropdown-item' href='/transporte/cadastros/usuarios/usuarios_lista.php'><img src='\transporte\imagens\equipe.png' alt='25' width='25' height='25'> Usuários do Sistema...</a>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                         <div style="padding-left :10px;">
                             <ul class="navbar-nav mr-auto">
                                 <li class='nav-item dropdown'>
                                     <!-- Opções de cadastro do menu -->
                                     <a class='nav-link dropdown-toggle' href='#' id='dropdown01' data-toggle='dropdown' aria-haspopup=true' aria-expanded='false'><img src='\transporte\imagens\resultado.png' alt='25' width='25' height='25'> Resultados</a>
                                     <div class='dropdown-menu' aria-labelledby='dropdown01'>
                                         <a class='dropdown-item' href='/transporte/cadastros/solicitantes/solicitantes_lista.php'> Resultados Gerais</a>
                                         <a class='dropdown-item' href='/gop/cadastros/recursos/recursos_lista.php'>por Solicitante</a>
                                         <a class='dropdown-item' href='/gop/cadastros/recursos/recursos_lista.php'>por Motorista</a>
                                         <a class='dropdown-item' href='/gop/cadastros/recursos/recursos_lista.php'>por Veículos</a>
                                         <a class='dropdown-item' href='/gop/cadastros/recursos/recursos_lista.php'>por Pacientes</a>

                                     </div>
                                 </li>
                             </ul>
                         </div>
                         <div style="padding-left :10px;">
                             <ul class="navbar-nav mr-auto">
                                 <li class='nav-item'><a href='/transporte/alterasenha.php' class='nav-link'><img src='\transporte\imagens\trocasenha.png' alt='25' width='25' height='25'> Alterar Senha</a></li>
                             </ul>
                         </div>
                     </div>
                 </nav>
                 <div class="panel default class">
                     <div class="alert alert-success">
                        <h5>
                         <strong>Login efetuado! - </strong>Bem vindo <?php echo ' ' . $_SESSION['c_usuario'] . ' - ' . $agora . ' '; ?>
                         <label for="usuario"></label>
                        </h5>
                     </div>
                 </div>

             </body>
             <!--   rodapé do menu   -->
             <div style="padding-bottom:15px;">
                 <footer>
                     <div style="padding-left :10px; padding-bottom:15px;">
                         <p>
                         <h4>Prefeitura Municipal de Sabará - Todos os direitos reservados</h4>
                         </p>
                     </div>
                 </footer>
             </div>
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
         float: right;
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