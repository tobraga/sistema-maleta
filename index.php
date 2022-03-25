<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Emprestimo de Maletas</title>
    <link rel="shortcut icon" href="imgs/favicon/favicon.ico" type="image/x-icon">

    <script src="lib/jquery/jquery.js" defer></script>

    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./lib/boxicons/css/boxicons.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="JS/script_main.js" defer></script>
    <link rel="stylesheet" href="css/style_main.css">

    <script src="lib/mask/script_mask.js" defer></script>

    <link rel="stylesheet" href="lib/icons/css/icons.css">

</head>

<body id="body-pd">

    <header class="header" id="header">
        <!--   <div class="header_toggle" id="header-toggle"><i class="gg-menu" id="bt-menu"></i></div>-->
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <img src="imgs/LogoNegativo.png" style="width: 10%" class="bx bx-layer nav_logo-icon">
                    <span class="nav_logo-name" "></span>
                </a>

                <div class=" nav_list">



                        <a href="pages/cadastro.php" target="_blank" class="nav_link" id="cadastro">
                            <div class="grid-icon">
                                <i class="gg-profile nav_icon"></i>
                                <span class="nav_name">Cadastrar Instituição</span>
                            </div>
                        </a>

                        <a href="pages/emprestimo.php" target="_blank" class="nav_link" id="emprestimo">
                            <div class="grid-icon">
                                <i class="gg-file-document nav_icon bx"></i>
                                <span class="nav_name">Solicitar Empréstimo</span>
                            </div>
                        </a>

                        <a href="pages/ativos.php"  target="_blank" class="nav_link" id="ativos">
                            <div class="grid-icon">
                                <i class="gg-view-list nav_icon bx"></i>
                                <span class="nav_name">Empréstimos Ativos / <br>Prorrogacao</span>
                            </div>
                        </a>


                        <a href="pages/historico.php" target="_blank" class="nav_link">
                            <div class="grid-icon">
                                <i class='bx bx-clipboard'></i>
                                <span class="nav_name">Historico</span>
                            </div>
                        </a>


                        <a href="pages/dashboard.php" target="_blank" class="nav_link active">
                            <div class="grid-icon">
                                <i class="gg-signal nav_icon bx"></i>
                                <span class="nav_name">Dashboard</span>
                            </div>
                        </a>

            </div>
    </div>

    <!--  
                <a href="editar.php" class="nav_link" id="editar">
                        <div class="grid-icon">
                            <i class="gg-pen nav_icon bx"></i>
                            <span class="nav_name">Editar empr�stimo</span>
                        </div>
                    </a>
    
            <a href="#" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        
         <a href="#" class="nav_link">
                        <div class="grid-icon">
                            <i class="gg-signal nav_icon bx"></i>
                            <span class="nav_name">Stats</span>
                        </div>
                    </a>-->
    </nav>
    </div>


    <div class="height-100 container-fluid" id="cont">
        <h4>Home</h4>
    </div>

</body>

</html>