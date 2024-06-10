<?php
session_start();

require_once './db/dbcon.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$pagina = 0;
if (isset($_GET["pagina"]))
    $pagina = $_GET["pagina"];

$page_file = "";

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <title>Exercícios RC</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.rtl.min.css" />

    <style>
        body {
            margin-bottom: 50px;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 50px;
        }
    </style>
</head>

<body>

    <?php
    if (!isset($_SESSION['user']))
        require "./pag/login.php";
    else {
        ?>
        <div class="p-5 bg-primary text-white text-center">
            <h1>Técnico de Gestão e Programação de Sistemas de Informação</h1>
            <p>
            <h3>Redes de Comunicação</h3>
            </p>
            <p>
            <h4>M5 - Criação de páginas web dinâmicas<h4>
                    </p>
        </div>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 0) ? "active" : ""; ?>" href="./?pagina=0">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 1) ? "active" : ""; ?>"
                            href="./?pagina=01">Departamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 2) ? "active" : ""; ?>"
                            href="./?pagina=02">Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 3) ? "active" : ""; ?>"
                            href="./?pagina=02">Utilizadores</a>
                    </li>
                </ul>

                <div class="d-flex">
                    <li class="nav-item">
                        <label class="nav-link active"><?= $_SESSION['user']['username'] ?></label>
                    </li>
                    <a class="btn btn-danger" href="./pag/logout.php">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container mt-5">

            <?php
            switch ($pagina) {
                case 0:
                    $page_file = "./home.php";
                    break;

                case 1:
                    $page_file = "./departamento/departamento.php";
                    break;
                case 2:
                    $page_file = "./funcionario/funcionario.php";
                    break;

                case 900:
                    $page_file = "./login.php";
                    break;

                default:
                    $page_file = "./pag/not_found.php";
                    break;
            }
            if (!file_exists($page_file))
                include ("./pag/not_found.php");
            else
                include ($page_file);
            ?>
        </div>

        <div class="footer mt-5 p-4 bg-primary text-white text-center">
            <p>&copy; 2024 - Tiago Rodrigues</p>
        </div>
        <?php
    }
    ?>
</body>

</html>