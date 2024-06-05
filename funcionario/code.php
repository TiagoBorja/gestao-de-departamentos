<?php
require '../db/dbcon.php';


if (isset($_GET['id_funcionario'])) {
    $id = filter_input(INPUT_GET, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT);

    if ($id === false || $id === null) {
        $resultado = [
            'status' => 422,
            'message' => "ID do funcionário inválido."
        ];
        echo json_encode($resultado);
        return;
    }

    $query = "SELECT f.*, d.nome AS departamento 
              FROM funcionario f
              LEFT JOIN departamento d ON f.id_departamento = d.id
              WHERE f.id = :id";
    $query_run = $pdo->prepare($query);

    $data = [
        ':id' => $id,
    ];

    try {
        $query_execute = $query_run->execute($data);
        $funcionario = $query_run->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            $resultado = [
                'status' => 200,
                'message' => "Funcionário encontrado.",
                'data' => $funcionario
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


if (isset($_POST['save_funcionario'])) {

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);
    $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_SPECIAL_CHARS);
    $departamento_id = filter_input(INPUT_POST, 'departamento', FILTER_VALIDATE_INT);

    if ($nome != "" && $email != "" && $data_nascimento != "" && $morada != "" && $departamento_id != "") {
        $query = "INSERT INTO funcionario (nome, email, data_nascimento, morada, id_departamento) VALUES (:nome, :email, :data_nascimento, :morada, :id_departamento)";
        $query_run = $pdo->prepare($query);

        $data = [
            ':nome' => $nome,
            ':email' => $email,
            ':data_nascimento' => $data_nascimento,
            ':morada' => $morada,
            ':id_departamento' => $departamento_id,
        ];

        try {
            $query_execute = $query_run->execute($data);

            if ($query_execute) {
                $resultado = [
                    'status' => 200,
                    'message' => "Funcionário criado com sucesso."
                ];
                echo json_encode($resultado);
                return;
            } else {
                $resultado = [
                    'status' => 500,
                    'message' => "O funcionário não foi criado com sucesso."
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

if (isset($_POST['update_funcionario'])) {
    $id = $_POST['id_funcionario'];
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);
    $morada = filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_SPECIAL_CHARS);
    $departamento_id = filter_input(INPUT_POST, 'departamento', FILTER_VALIDATE_INT);

    if ($nome != "" && $email != "" && $data_nascimento != "" && $morada != "" && $departamento_id != "") {

        $query = "UPDATE funcionario SET nome = :nome, email = :email, data_nascimento = :data_nascimento, morada = :morada, id_departamento = :id_departamento WHERE id = :id";
        $query_run = $pdo->prepare($query);

        $data = [
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':data_nascimento' => $data_nascimento,
            ':morada' => $morada,
            ':id_departamento' => $departamento_id,
        ];

        try {
            $query_execute = $query_run->execute($data);

            if ($query_execute) {
                $resultado = [
                    'status' => 200,
                    'message' => "Funcionário atualizado com sucesso."
                ];
            } else {
                $resultado = [
                    'status' => 500,
                    'message' => "O funcionário não foi atualizado com sucesso."
                ];
            }
        } catch (PDOException $e) {
            $resultado = [
                'status' => 500,
                'message' => "Erro ao atualizar: " . $e->getMessage()
            ];
        }
    } else {
        $resultado = [
            'status' => 422,
            'message' => "Preencha todos os campos antes de prosseguir."
        ];
    }
    echo json_encode($resultado);
}

if (isset($_POST['delete_funcionario'])) {

    $id = filter_input(INPUT_POST, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
    $query = "DELETE FROM funcionario 
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
                'message' => "Funcionário excluído com sucesso!",
            ];
            echo json_encode($resultado);
            return;
        }
    } catch (PDOException $e) {
        $resultado = [
            'status' => 500,
            'message' => "Não foi possível excluir o funcionário",
        ];
        echo json_encode($resultado);
        return;
    }
}
