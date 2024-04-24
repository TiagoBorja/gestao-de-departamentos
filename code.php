<?php

require 'dbcon.php';
if (isset($_POST['save_student'])) {
    $nome = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telemovel = mysqli_real_escape_string($con, $_POST['phone']);
    $curso = mysqli_real_escape_string($con, $_POST['course']);

    if ($nome == NULL || $email == NULL || $telemovel == NULL || $curso == NULL) {

        $resultado = [
            'status' => 422,
            'message' => "Preencha todos os campos antes de prosseguir."
        ];
        echo json_encode($resultado);
        return false;
    }

    $query = "INSERT INTO students (name,email,phone,course) 
              VALUES ('$nome','$email','$telemovel','$curso')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        //Caso ocorra tudo bem, o estudante é criado e o utilizador recebe uma mensagem confirmando.
        $resultado = [
            'status' => 200,
            'message' => "Estudante criado com sucesso."
        ];
        echo json_encode($resultado);
        return false;
    } else {
        //Caso ocorra algum problema interno no servidor, não será feito nada e o utilizador irá ser notificado. 
        $resultado = [
            'status' => 500,
            'message' => "O estudante não foi criado com sucesso."
        ];
        echo json_encode($resultado);
        return false;
    }
}
?>