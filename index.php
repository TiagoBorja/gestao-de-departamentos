<?php
session_start();
$pagina = 0;
if (isset($_GET["pagina"]))
    $pagina = $_GET["pagina"];

$page_file = "";

include ('./template/header.php');

if (!isset($_SESSION['user']))
    require "./pag/login.php";
else {
    ?>

    <body>

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

        <?php include ('./template/footer.php'); ?>

    </body>
    <?php
}
?>

</html>