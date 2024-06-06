<?php
$query = "SELECT * FROM departamento";

$query_run = $pdo->prepare($query);

try {
    // Obter dados dos departamentos
    $query_run->execute();
    $departamentos = $query_run->fetchAll(PDO::FETCH_ASSOC);

    // Verificar se há departamentos
    if (count($departamentos) > 0) {
        foreach ($departamentos as $departamento) {
?>
            <tr>
                <td><?= htmlspecialchars($departamento['id']); ?></td>
                <td><?= htmlspecialchars($departamento['nome']); ?></td>
                <td>
                    <button type="button" value="<?= $departamento['id']; ?>" class="viewDepartamentoBtn btn btn-secondary btn-sm">Visualizar</button>
                    <button type="button" value="<?= $departamento['id']; ?>" class="editDepartamentoBtn btn btn-primary btn-sm">Atualizar</button>
                    <button type="button" value="<?= $departamento['id']; ?>" class="deleteDepartamentoBtn btn btn-danger btn-sm">Excluir</button>
                </td>
            </tr>
<?php
        }
    } else {
        echo "<tr><td colspan='3'>Nenhum departamento encontrado</td></tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='3'>Erro ao buscar os departamentos: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>