<?php
session_start();
require './dbcon.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {

    $username = $_POST["username"];
    $senha = sha1($_POST["password"]);

    try {
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $senha, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $row;
        } else {
            $_SESSION['erro_login'] = "Utilizador/Password inválidos!";
        }
    } catch (PDOException $e) {

        $_SESSION['erro_login'] = "Erro ao tentar fazer login: " . $e->getMessage();
    }

    header('Location: ../');
    exit();
}
?>