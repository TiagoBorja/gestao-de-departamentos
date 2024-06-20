<!-- Adicionar Funcionario -->
<div class="modal fade" id="utilizadorAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveUtilizador">
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessage"></div>
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="tipo" required>
                            <option value="Administrador">Administrador</option>
                            <option value="Gestor">Gestor</option>
                            <option value="Utilizador">Utilizador</option>
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

<!-- Editar Utilizador -->
<div class="modal fade" id="utilizadorEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atualizar Utilizador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUtilizador">
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessageUpdate"></div>
                    <input type="text" name="id_utilizador" id="id_utilizador">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="tipo" id="tipo" required>
                            <option value="Administrador">Administrador</option>
                            <option value="Gestor">Gestor</option>
                            <option value="Utilizador">Utilizador</option>
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
<div class="modal fade" id="utilizadorViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning d-none" id="errorMessageView"></div>
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <p id="view_nome" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <p id="view_username" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Utilizador</label>
                    <p id="view_tipo" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Excluir Utilizador -->
<div class="modal fade" id="utilizadorDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Excluir Utilizador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteUtilizador">
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessageDelete"></div>
                    <input type="hidden" name="id_utilizador" id="delete_id_utilizador">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <p id="delete_nome" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <p id="delete_username" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <p id="delete_tipo" class="form-control"></p>
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Detalhes Utilizador
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal"
                        data-bs-target="#utilizadorAddModal">
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
                            <th>Username</th>
                            <th>Tipo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php require 'db/utilizador/carregarUtilizador.php'; ?>
                    </tbody>
                </table>
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
<script src="js/utilizador.js"></script>