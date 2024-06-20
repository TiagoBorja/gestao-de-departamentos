<!-- Adicionar Departamento Modal -->
<div class="modal fade" id="departamentoAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveDepartamento">
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessage"></div>
                    <div class="mb-3">
                        <label class="form-label">Nome do Departamento</label>
                        <input type="text" name="nome" class="form-control" required>
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

<!-- Editar Departamento Modal -->
<div class="modal fade" id="departamentoEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateDepartamento">
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessageUpdate"></div>
                    <input type="hidden" name="edit_id_departamento" id="edit_id_departamento">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" id="edit_nome" name="edit_nome" class="form-control" required>
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

<!-- Visualizar Departamento Modal -->
<div class="modal fade" id="departamentoViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning d-none" id="errorMessage"></div>
                <div class="mb-3">
                    <label class="form-label">Código Departamento</label>
                    <p id="view_id" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <p id="view_departamento" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Excluir Departamento Modal -->
<div class="modal fade" id="departamentoDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Excluir Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteDepartamento">
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessage"></div>
                    <input type="hidden" name="delete_id_departamento" id="delete_id_departamento">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <p id="delete_nome" class="form-control"></p>
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

<!-- Conteúdo da Página -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Detalhes Departamento
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal"
                        data-bs-target="#departamentoAddModal">Novo</button>
                </h4>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php require 'db/departamento/carregarDepartamentos.php'; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Imports -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

<!-- DataTable e Scripts -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script src="./js/departamento.js"></script>