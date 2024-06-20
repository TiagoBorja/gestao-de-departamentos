<?php
$coddep = 0;
$filtrocd = "";
if (isset($_GET['cod_departamento'])) {
    $coddep = $_GET["cod_departamento"];
    $filtrocd = " WHERE id_departamento = " . $coddep;
}
?>

<div class="row">
    <div class="col-md-4">
        <h5>Departamentos</h5>
        <hr>
        <ul class="list-group list-group">

            <li class="list-group-item list-group-item-action"><a href="./">Todos</a></li>
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
                        <li class="list-group-item list-group-item-action"><a
                                href="./?cod_departamento=<?= $departamento['id']; ?>"><?= $departamento['nome']; ?></a>
                        </li>
                        <?php
                    }
                } else {
                    echo "<ul><li colspan='3'>Nenhum departamento encontrado</li></ul>";
                }
            } catch (PDOException $e) {
                echo "<ul><li colspan='3'>Erro ao buscar os departamentos: " . $e->getMessage() . "</li></ul>";
            }
            ?>
        </ul>
    </div>
    <div class="col-md-8">
        <h5>Funcionários</h5>
        <hr>
        <ul class="list-group">
            <?php

            try {
                // Obter dados dos funcionários
                $stmt = $pdo->query("SELECT * FROM funcionario" . $filtrocd);
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
                        <li class="list-group-item list-group-item-action"><?= $funcionario['nome']; ?> -
                            <?= $departamentos_map[$funcionario['id_departamento']] ?? 'Departamento desconhecido'; ?>
                        </li>
                        <?php
                    }
                } else {
                    echo "<ul><li colspan='7'>Nenhum funcionário encontrado</li></ul>";
                }
            } catch (PDOException $e) {
                echo "<ul><li colspan='7'>Erro ao buscar funcionários: " . $e->getMessage() . "</li></ul>";
            }

            ?>
        </ul>
    </div>
</div>