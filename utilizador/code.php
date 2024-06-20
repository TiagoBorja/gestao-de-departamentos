<?php
require '../db/dbcon.php';

// Verifica se foi passado um ID de utilizador via GET
if (isset($_GET['id_utilizador'])) {

    $id = filter_input(INPUT_GET, 'id_utilizador', FILTER_SANITIZE_NUMBER_INT);

    // Validação básica do ID do utilizador
    if ($id === false || $id === null) {
        $resultado = [
            'status' => 422,
            'message' => "ID do utilizador inválido."
        ];
        echo json_encode($resultado);
        return;
    }

    // Consulta SQL para buscar os dados do utilizador pelo ID
    $query = "SELECT id, nome, username, tipo FROM users WHERE id = :id";
    $query_run = $pdo->prepare($query);

    try {
        // Executa a consulta passando o ID como parâmetro
        $query_run->bindParam(':id', $id, PDO::PARAM_INT);
        $query_execute = $query_run->execute();

        // Obtém os dados do utilizador
        $funcionario = $query_run->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            $resultado = [
                'status' => 200,
                'message' => "Utilizador encontrado.",
                'data' => $funcionario
            ];
        } else {
            $resultado = [
                'status' => 404,
                'message' => "Utilizador não encontrado."
            ];
        }
        echo json_encode($resultado);
    } catch (PDOException $e) {
        $resultado = [
            'status' => 500,
            'message' => "Erro ao encontrar o utilizador: " . $e->getMessage()
        ];
        echo json_encode($resultado);
    }
}

// Verifica se foi submetido o formulário para salvar um novo utilizador
if (isset($_POST['save_utilizador'])) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validação adicional dos campos do formulário
    if (
        !is_string($nome) || empty($nome) ||
        !is_string($username) || empty($username) ||
        !is_string($senha) || empty($senha) ||
        !is_string($tipo) || empty($tipo)
    ) {

        $resultado = [
            'status' => 422,
            'message' => "Preencha todos os campos com dados válidos."
        ];
        echo json_encode($resultado);
        return;
    }

    $query = "INSERT INTO users (nome, username, password, tipo) VALUES (:nome, :username, :senha, :tipo)";
    $query_run = $pdo->prepare($query);

    // Dados a serem inseridos
    $data = [
        ':nome' => $nome,
        ':username' => $username,
        ':senha' => sha1($senha), // Hash da senha (não recomendado, usar bcrypt ou similar)
        ':tipo' => $tipo,
    ];

    try {
        // Executa a query para inserção
        $query_execute = $query_run->execute($data);

        if ($query_execute) {
            $resultado = [
                'status' => 200,
                'message' => "Utilizador criado com sucesso."
            ];
        } else {
            $resultado = [
                'status' => 500,
                'message' => "Erro ao inserir o utilizador."
            ];
        }
        echo json_encode($resultado);
    } catch (PDOException $e) {
        $resultado = [
            'status' => 500,
            'message' => "Erro ao inserir o utilizador: " . $e->getMessage()
        ];
        echo json_encode($resultado);
    }
}

if (isset($_POST['update_utilizador'])) {

    $id = filter_input(INPUT_POST, 'id_utilizador', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);



    if (
        !is_string($nome) || empty($nome) ||
        !is_string($username) || empty($username) ||
        !is_string($tipo) || empty($tipo)
    ) {

        $resultado = [
            'status' => 422,
            'message' => "Preencha todos os campos com dados válidos."
        ];
        echo json_encode($resultado);
        return;
    }

    $query = "UPDATE users 
              SET nome = :nome, username = :username, tipo = :tipo
              WHERE id = :id";
    $query_run = $pdo->prepare($query);

    $data = [
        ':nome' => $nome,
        ':username' => $username,
        ':tipo' => $tipo,
        ':id' => $id
    ];

    try {
        $query_execute = $query_run->execute($data);

        if ($query_execute) {
            $resultado = [
                'status' => 200,
                'message' => "Utilizador atualizado com sucesso."
            ];
        } else {
            $resultado = [
                'status' => 500,
                'message' => "Erro ao inserir o utilizador."
            ];
        }
        echo json_encode($resultado);
    } catch (PDOException $e) {
        $resultado = [
            'status' => 500,
            'message' => "Erro ao inserir o utilizador: " . $e->getMessage()
        ];
        echo json_encode($resultado);
    }
}

if (isset($_POST['delete_utilizador'])) {

    $id = filter_input(INPUT_POST, 'id_utilizador', FILTER_SANITIZE_NUMBER_INT);
    $query = "DELETE FROM users 
              WHERE id = :id";
    $query_run = $pdo->prepare($query);

    $data = [
        ':id' => $id,
    ];

    try {
        $query_execute = $query_run->execute($data);

        if ($query_execute) {
            $resultado = [
                'status' => 200,
                'message' => "Utilizador excluído com sucesso!",
            ];
            echo json_encode($resultado);
            return;
        }
    } catch (PDOException $e) {
        $resultado = [
            'status' => 500,
            'message' => "Não foi possível excluir o utilizador",
        ];
        echo json_encode($resultado);
        return;
    }
}
?>