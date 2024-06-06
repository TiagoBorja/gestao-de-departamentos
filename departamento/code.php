<?php
require_once '../db/dbcon.php';

if (isset($_GET['id_departamento'])) {

    $id = filter_input(INPUT_GET, 'id_departamento', FILTER_SANITIZE_NUMBER_INT);

    if ($id === false || $id === null) {
        $resultado = [
            'status' => 422,
            'message' => "ID do departamento inválido."
        ];
        echo json_encode($resultado);
        return;
    }

    $query = "SELECT * FROM departamento
              WHERE id = :id";
    $query_run = $pdo->prepare($query);

    $data = [
        ':id' => $id,
    ];

    try {
        $query_execute = $query_run->execute($data);
        $departamento = $query_run->fetch(PDO::FETCH_ASSOC);

        if ($departamento) {
            $resultado = [
                'status' => 200,
                'message' => "Funcionário encontrado.",
                'data' => $departamento
            ];
        } else {
            $resultado = [
                'status' => 404,
                'message' => "Funcionário não encontrado."
            ];
        }
        echo json_encode($resultado);
    } catch (PDOException $e) {
        $resultado = [
            'status' => 500,
            'message' => "Erro ao encontrar o funcionário: " . $e->getMessage()
        ];
        echo json_encode($resultado);
    }

}

if (isset($_POST['save_departamento'])) {

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);


    if ($nome != "") {
        $query = "INSERT INTO departamento (nome) VALUES (:nome)";
        $query_run = $pdo->prepare($query);

        $data = [
            ':nome' => $nome,
        ];

        try {
            $query_execute = $query_run->execute($data);

            if ($query_execute) {
                $resultado = [
                    'status' => 200,
                    'message' => "Departamento criado com sucesso."
                ];
                echo json_encode($resultado);
                return;
            } else {
                $resultado = [
                    'status' => 500,
                    'message' => "O departamento não foi criado com sucesso."
                ];
                echo json_encode($resultado);
                return;
            }
        } catch (PDOException $e) {
            $resultado = [
                'status' => 500,
                'message' => "Erro ao inserir: " . $e->getMessage()
            ];
            echo json_encode($resultado);
            return;
        }
    } else {
        $resultado = [
            'status' => 422,
            'message' => "Preencha todos os campos antes de prosseguir."
        ];
        echo json_encode($resultado);
        return;
    }
}


