<?php
$coddep = $codfunc = 0;
$filtro_cd = $filtro_func = "";

if (isset($_GET['cod_departamento'])) {
    $coddep = $_GET["cod_departamento"];
    $filtro_cd = " WHERE id_departamento = " . $coddep;
}

if (isset($_GET['cod_funcionario'])) {
    $codfunc = $_GET['cod_funcionario'];
    $filtro_func = " WHERE id = " . $codfunc;
}
?>

<div class="row">
    <div class="col-md-4">
        <h5>Departamentos</h5>
        <hr>
        <ul class="list-group list-group">

            <li class="list-group-item list-group-item-action"><a href="./">Todos</a></li>
            <?php
            // Consulta para obter os departamentos
            $query = "SELECT * FROM departamento";
            $query_run = $pdo->prepare($query);

            try {
                $query_run->execute();
                $departamentos = $query_run->fetchAll(PDO::FETCH_ASSOC);

                if (count($departamentos) > 0) {
                    foreach ($departamentos as $departamento) {
                        ?>
                        <li class="list-group-item list-group-item-action">
                            <a href="./?cod_departamento=<?= $departamento['id']; ?>">
                                <?= $departamento['nome']; ?>
                            </a>
                        </li>
                        <?php
                    }
                } else {
                    echo "<li class='list-group-item'>Nenhum departamento encontrado</li>";
                }
            } catch (PDOException $e) {
                echo "<li class='list-group-item'>Erro ao buscar os departamentos: " . $e->getMessage() . "</li>";
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
                // Consulta para obter os funcionários filtrados
                $stmt = $pdo->query("SELECT * FROM funcionario" . $filtro_cd . $filtro_func);
                $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Obter dados dos departamentos
                $stmt_departamento = $pdo->query("SELECT id, nome FROM departamento");
                $departamentos = $stmt_departamento->fetchAll(PDO::FETCH_ASSOC);

                // Variável responsável pelo mapeamento dos departamentos baseado no ID
                $departamentos_map = [];
                foreach ($departamentos as $departamento) {
                    $departamentos_map[$departamento['id']] = $departamento['nome'];
                }

                if (count($funcionarios) > 0) {
                    foreach ($funcionarios as $funcionario) {
                        ?>
                        <li class="list-group-item list-group-item-action">
                            <a href="./?cod_funcionario=<?= $funcionario['id']; ?>">
                                <?= $funcionario['nome']; ?>
                            </a>
                            -
                            <?= $departamentos_map[$funcionario['id_departamento']]; ?>
                        </li>
                        <?php
                    }
                } else {
                    echo "<li class='list-group-item'>Nenhum funcionário encontrado</li>";
                }
            } catch (PDOException $e) {
                echo "<li class='list-group-item'>Erro ao buscar funcionários: " . $e->getMessage() . "</li>";
            }
            ?>
        </ul>
        <?php if ($codfunc > 0) { ?>
            <div class="card mt-4">
                <div class="card-header">
                    Detalhes do Funcionário
                </div>
                <div class="card-body">
                    <?php
                    try {
                        // Consulta para obter os detalhes do funcionário específico
                        $stmt = $pdo->query("SELECT * FROM funcionario WHERE id = " . $codfunc);
                        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($funcionario) {
                            ?>
                            <p>
                                <strong>Nome:</strong> <?= $funcionario['nome'] ?>
                            </p>
                            <p>
                                <strong>Email:</strong> <?= $funcionario['email'] ?>
                            </p>
                            <p>
                                <strong>Data de Nascimento:</strong> <?= $funcionario['data_nascimento'] ?>
                            </p>
                            <p>
                                <strong>Morada:</strong> <?= $funcionario['morada'] ?>
                            </p>
                            <p>
                                <strong>Departamento:</strong> <?= $departamentos_map[$funcionario['id_departamento']]; ?>
                            </p>
                            <a class="btn btn-secondary btn-sm float-end" href="./">Voltar</a>
                            <?php
                        } else {
                            echo "<p>Funcionário não encontrado.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erro ao buscar funcionário: " . $e->getMessage() . "</p>";
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>