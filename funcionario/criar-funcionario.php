<?php
include '../template/header.php';
require '../db/dbcon.php';
?>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar Funcionário
                            <a class="btn btn-danger float-end" href="funcionario.php">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="code.php">
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data de Nascimento</label>
                                <input type="date" name="data_nascimento" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Morada</label>
                                <textarea type="text" name="morada" class="form-control" required></textarea>
                            </div>
                            <select class="form-select" name="departamento" required>
                                <?php
                                $query_departamento = "SELECT id, nome FROM departamento";
                                $query_run_departamento = mysqli_query($conn, $query_departamento);

                                if (mysqli_num_rows($query_run_departamento) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run_departamento)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhum departamento encontrado</option>";
                                }
                                ?>
                            </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="criar_funcionario" class="btn btn-success float-end">Criar
                            Funcionário</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
    include '../template/footer.php';
    ?>
</body>