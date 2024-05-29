<?php

$host = 'localhost';
$db = 'empresa_final_tiago';
$user = 'root';
$password = '';

$conn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {

    $pdo = new PDO($conn, $user, $password);
    if ($pdo) {

    }
} catch (PDOException $e) {
    //echo $e->getMessage();
    die("Impossível estabelecer a conexão!");
}
?>