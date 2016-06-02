 <?php



 require_once("model/autenticacao.model.php") ?>

 <!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo isset($tituloPagina) ? $tituloPagina: "AlbertEinstein"; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo1.png" alt="Logotipo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <?php




                    if (isUserMedico()): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pacientes<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href='pacientes.php'>Gestão de Paciente</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href='PesquisaUtente.php'>Pesquisar Pacientes</a></li>
                                <li><a href='Registoconsulta.php'>Registar Consultas</a></li>

                                <li><a href='listarMedicamentos.php'>Medicação do Paciente</a></li>
                            </ul>
                        </li>

                    <?php elseif (isUserAdministrativo()) : ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pacientes<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href='paciente_lista.php'>Lista de Pacientes</a></li>
                                <li><a href='paciente_create.php'>Inserir Paciente</a></li>
                                <li><a href='pacientes.php'>Gestão de Paciente</a></li>
                            </ul>
                        </li>

                    <?php elseif (isUserEnfermeiro()):?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href='listarMedicamentos.php'>Medicação do Paciente</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pacientes<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href='pacientes.php'>Gestão de Paciente</a></li>
                            </ul>
                        </li>

                    <?php elseif ( isUserAdministrador()):?>
                        <li>
                            <a href="utilizadores.php">Utilizadores</a>
                        </li>
                    <?php else:?>


                    <?php endif;?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if(isUserAnonimo()): ?>
                        <li>
                            <a href="login.php">Login</a>
                        </li>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo getUserInfo()['username'];?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href='#'>Alterar Senha</a></li>
                                <li><a href='logout.php'>Sair</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><?php echo isset($tituloPagina) ? $tituloPagina: ""; ?></h1>
            </div>
        </div>
        
        
       
