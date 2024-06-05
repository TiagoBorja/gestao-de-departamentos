<?php

try {
    // Obter dados dos funcionários
    $stmt = $pdo->query("SELECT * FROM funcionario");
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obter dados dos departamentos
    $stmt_departamento = $pdo->query("SELECT id, nome FROM departamento");
    $departamentos = $stmt_departamento->fetchAll(PDO::FETCH_ASSOC);

    //Variável responsavel pelo mapeamento dos deparmentos baseado no ID
    $departamentos_map = [];
    foreach ($departamentos as $departamento) {
        $departamentos_map[$departamento['id']] = $departamento['nome'];
    }

    // Verificar se há funcionários
    if (count($funcionarios) > 0) {
        foreach ($funcionarios as $funcionario) {
            ?>
            <tr>
                <td><?= $funcionario['id']; ?></td>
                <td><?= $funcionario['nome']; ?></td>
                <td><?= $funcionario['email']; ?></td>
                <td><?= $funcionario['data_nascimento']; ?></td>
                <td><?= $funcionario['morada']; ?></td>
                <td><?= $departamentos_map[$funcionario['id_departamento']] ?? 'Departamento desconhecido'; ?>
                </td>
                <td>
                    <button type="button" value="<?= $funcionario['id']; ?>"
                        class="viewFuncionarioBtn btn btn-secondary btn-sm">Visualizar</button>
                    <button type="button" value="<?= $funcionario['id']; ?>"
                        class="editFuncionarioBtn btn btn-primary btn-sm">Atualizar</button>
                    <button type="button" value="<?= $funcionario['id']; ?>"
                        class="deleteFuncionarioBtn btn btn-danger btn-sm">Excluir</button>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7'>Nenhum funcionário encontrado</td></tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='7'>Erro ao buscar funcionários: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}

?>