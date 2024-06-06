<!-- Adicionar Funcionario -->
<div class="modal fade" id="funcionarioAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </div>
            <form id="saveFuncionario">
                <div class="modal-body">

                    <div class="alert alert-warning d-none" id="errorMessage">
                    </div>

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
                        $query = "SELECT id, nome FROM departamento";
                        $stmt = $pdo->prepare($query);

                        try {
                            $stmt->execute();
                            $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($departamentos) > 0) {
                                foreach ($departamentos as $departamento) {
                                    echo "<option value='" . htmlspecialchars($departamento['id']) . "'>" . htmlspecialchars($departamento['nome']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhum departamento encontrado</option>";
                            }
                        } catch (PDOException $e) {
                            echo "<option value=''>Erro ao buscar departamentos: " . htmlspecialchars($e->getMessage()) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Editar Funcionario -->
<div class="modal fade" id="funcionarioEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atualizar Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateFuncionario">
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessage"></div>
                    <input type="hidden" name="id_funcionario" id="id_funcionario">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Morada</label>
                        <textarea type="text" id="morada" name="morada" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Departamento</label>
                        <select class="form-select" id="departamento" name="departamento" required>
                            <?php
                            $query = "SELECT * FROM departamento";
                            $stmt = $pdo->prepare($query);

                            try {
                                $stmt->execute();
                                $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (count($departamentos) > 0) {
                                    foreach ($departamentos as $departamento) {
                                        echo "<option value='" . htmlspecialchars($departamento['id']) . "'>" . htmlspecialchars($departamento['nome']) . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhum departamento encontrado</option>";
                                }
                            } catch (PDOException $e) {
                                echo "<option value=''>Erro ao buscar departamentos: " . htmlspecialchars($e->getMessage()) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Visualizar Funcionario -->
<div class="modal fade" id="funcionarioViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="alert alert-warning d-none" id="errorMessage">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <p id="view_nome" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <p id="view_email" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Data de Nascimento</label>
                    <p id="view_data_nascimento" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Morada</label>
                    <p id="view_morada" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Departamento</label>
                    <p id="view_departamento" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Excluir funcionario -->
<div class="modal fade" id="funcionarioDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="deleteFuncionario">
                <div class="modal-body">

                    <div class="alert alert-warning d-none" id="errorMessage">
                    </div>

                    <input type="text" name="id_funcionario" id="id_funcionario">

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <p id="delete_nome" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <p id="delete_email" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <p id="delete_data_nascimento" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Morada</label>
                        <p id="delete_morada" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Departamento</label>
                        <p id="delete_departamento" class="form-control"> </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detalhes Funcionários
                        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal"
                            data-bs-target="#funcionarioAddModal">
                            Novo
                        </button>
                    </h4>
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data de Nascimento</th>
                                <th>Morada</th>
                                <th>Departamento</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'db/funcionario/carregarFuncionario.php';
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

<!-- Data Table -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

<script src="js/funcionario.js"></script>