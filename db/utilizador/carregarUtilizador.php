<?php
$query = "SELECT * FROM users";

$query_run = $pdo->prepare($query);

try {
    // Obter dados dos utilizadores
    $query_run->execute();
    $utilizadores = $query_run->fetchAll(PDO::FETCH_ASSOC);

    // Verificar se há utilizadores
    if (count($utilizadores) > 0) {
        foreach ($utilizadores as $utilizador) {
            ?>
            <tr>
                <td><?= $utilizador['id']; ?></td>
                <td><?= $utilizador['nome']; ?></td>
                <td><?= $utilizador['username']; ?></td>
                <td><?= $utilizador['tipo']; ?></td>
                <td>
                    <button type="button" value="<?= $utilizador['id']; ?>"
                        class="viewUtilizadorBtn btn btn-secondary btn-sm">Visualizar</button>
                    <button type="button" value="<?= $utilizador['id']; ?>"
                        class="editUtilizadorBtn btn btn-primary btn-sm">Atualizar</button>
                    <button type="button" value="<?= $utilizador['id']; ?>"
                        class="deleteUtilizadorBtn btn btn-danger btn-sm">Excluir</button>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='3'>Nenhum departamento encontrado</td></tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='3'>Erro ao buscar os utilizadores: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>