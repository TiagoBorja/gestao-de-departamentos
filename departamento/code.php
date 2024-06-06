<?php
require_once '../db/dbcon.php';
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
