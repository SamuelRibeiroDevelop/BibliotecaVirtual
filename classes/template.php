<?php

class template
{
    function head(){
        session_start();
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['password']) == true))
        {
            unset($_SESSION['login']);
            unset($_SESSION['password']);
            header('location:login.php');
        }
        $logado = $_SESSION['name'];

        echo "<!DOCTYPE html>
<html lang=\"en\">

<head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>Biblioteca Virtual | Home</title>

    <!-- Bootstrap Core CSS -->
    <link href=\"assets/vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- MetisMenu CSS -->
    <link href=\"assets/vendor/metisMenu/metisMenu.min.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"assets/dist/css/sb-admin-2.css\" rel=\"stylesheet\">

    <!-- Custom Fonts -->
    <link href=\"assets/vendor/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->

</head>
<body>";
    }

    function footer(){

        echo "<footer class=\"page-footer font-small blue pt-4\">
            <div class=\"footer-copyright text-center py-3\">© 2018 Copyright. Biblioteca Virtual.
            </div>
        </footer>

    </div>

    <!-- jQuery -->
    <script src=\"assets/vendor/jquery/jquery.min.js\"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=\"assets/vendor/bootstrap/js/bootstrap.min.js\"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src=\"assets/vendor/metisMenu/metisMenu.min.js\"></script>

    <!-- Custom Theme JavaScript -->
    <script src=\"assets/dist/js/sb-admin-2.js\"></script>

</body>

</html>";

    }

    function navbartop(){

        echo "<body>
    <div id=\"wrapper\">
        <nav class=\"navbar navbar-default navbar-static-top\" role=\"navigation\" style=\"margin-bottom: 0\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"#\"><b>Biblioteca Virtual</b></a>
            </div>
            <ul class=\"nav navbar-top-links navbar-right\">
                <li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                        <i class=\"fa fa-user fa-fw\"></i> <i class=\"fa fa-caret-down\"></i>
                    </a>
                    <ul class=\"dropdown-menu dropdown-user\">
                        <li><a href=\"logout.php\"><i class=\"fa fa-sign-out fa-fw\"></i> Logout</a>
                        </li>
                        <li><a href=\"login.php\"><i class=\"fa fa-sign-in fa-fw\"></i> Login</a>
                        </li>
                    </ul>
                </li>
            </ul>";

    }

    function sidebar()
    {

        echo "<div class=\"navbar-default sidebar\" role=\"navigation\">
                <div class=\"sidebar-nav navbar-collapse\">
                    <ul class=\"nav\" id=\"side-menu\">
                        <li class=\"sidebar-search\">
                            <div class=\"input-group custom-search-form\">
                                <center><img src=\"assets/img/logobv.png\"></center>
                            </div>
                        </li>
                        <li>
                            <a href=\"index.php\"><i class=\"fa fa-home fa-fw\"></i> Página Inicial</a>
                        </li>
                        <li>
                            <a href=\"#\"><i class=\"fa fa-book fa-fw\"></i> Livros<span class=\"fa arrow\"></span></a>
                            <ul class=\"nav nav-second-level\">
                                <li>
                                    <a href=\"#\"><i class=\"fa fa-search fa-fw\"></i> Consultar</a>
                                </li>
                                <li>
                                    <a href=\"#\"><i class=\"fa fa-plus-circle fa-fw\"></i> Cadastrar</a>
                                </li>
                                <li>
                            <a href=\"#\"><i class=\"fa fa-book fa-fw\"></i> Exemplares<span class=\"fa arrow\"></span></a>
                            <ul class=\"nav nav-second-level\">
                                <li>
                                    <a href=\"#\"><i class=\"fa fa-search fa-fw\"></i> Consultar</a>
                                </li>";
                                if($_SESSION['tipo'] == 0){
                                echo"<li>
                                    <a href=\"#\"><i class=\"fa fa-plus-circle fa-fw\"></i> Gerenciar Exemplares</a>
                                </li>
                            </ul>
                        </li>";
                        }
                        if($_SESSION['tipo'] == 0){
                            echo"<li>
                            <a href=\"#\"><i class=\"fa fa-book fa-fw\"></i> Categorias<span class=\"fa arrow\"></span></a>
                            <ul class=\"nav nav-second-level\">
                                <li>
                                    <a href=\"categoria.php\"><i class=\"fa fa-cogs fa-fw\"></i> Gerenciar Categorias</a>
                                </li>
                            </ul>
                        </li>
                            </ul>
                        </li>";
                        }
                        if($_SESSION['tipo'] == 0){
                        echo" < li>
                            <a href = \"#\"><i class=\"fa fa-user fa-fw\"></i> Usuários<span class=\"fa arrow\"></span></a>
                            <ul class=\"nav nav-second-level\">
                                <li>
                                    <a href=\"usuario.php\"><i class=\"fa fa-cogs fa-fw\"></i> Gerenciar Usuários</a>
                                </li>
                            </ul>
                        </li>";
                        }
               echo"</ul>
                </div>
            </div>
        </nav>";
    }

    function bodypage(){

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("F j, Y");

        echo "<h6 style='text-align: center'>$data</h6>";
    }
}