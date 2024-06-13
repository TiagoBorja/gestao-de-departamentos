<?php
require '../db/dbcon.php';

if (isset($_POST['save_utilizador'])) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validação adicional
    if (!is_string($nome) || empty($nome)) {
        $resultado = [
            'status' => 422,
            'message' => "Nome é obrigatório e deve ser válido."
        ];
        echo json_encode($resultado);
        return false;
    }

    if (!is_string($username) || empty($username)) {
        $resultado = [
            'status' => 422,
            'message' => "Username é obrigatório e deve ser válido."
        ];
        echo json_encode($resultado);
        return false;
    }

    if (!is_string($senha) || empty($senha)) {
        $resultado = [
            'status' => 422,
            'message' => "Senha é obrigatória e deve ser válida."
        ];
        echo json_encode($resultado);
        return false;
    }

    if (!is_string($tipo) || empty($tipo)) {
        $resultado = [
            'status' => 422,
            'message' => "Tipo é obrigatório e deve ser válido."
        ];
        echo json_encode($resultado);
        return false;
    }

    if (!empty($nome) && !empty($username) && !empty($senha) && !empty($tipo)) {
        $query = "INSERT INTO users (nome, username, password, tipo) VALUES (:nome, :username, :senha, :tipo)";
        $query_run = $pdo->prepare($query);

        $data = [
            ':nome' => $nome,
            ':username' => $username,
            ':senha' => sha1($senha), // Senha hash
            ':tipo' => $tipo,
        ];

        try {
            $query_execute = $query_run->execute($data);

            if ($query_execute) {
                $resultado = [
                    'status' => 200,
                    'message' => "Utilizador criado com sucesso."
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
            'message' => "Preencha todos os campos com dados válidos."
        ];
        echo json_encode($resultado);
        return false;
    }
}
?>