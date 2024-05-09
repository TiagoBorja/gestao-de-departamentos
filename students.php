<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Crud Ajax</title>
</head>

<body>
    <!-- Adicionar estudantes -->
    <div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Estudante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <form id="saveStudent">
                    <div class="modal-body">

                        <div class="alert alert-warning d-none" id="errorMessage">
                        </div>

                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Telemóvel</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Curso</label>
                            <input type="text" name="course" class="form-control">
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
    <!-- Atualizar estudantes -->
    <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atualizar Estudante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateStudent">
                    <div class="modal-body">

                        <div class="alert alert-warning d-none" id="errorMessageUpdate">
                        </div>
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Telemóvel</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Curso</label>
                            <input type="text" name="course" id="course" class="form-control">
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

    <!-- Vizualizar estudantes -->
    <div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informações Estudante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nome</label>
                        <p id="view_name" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <p id="view_email" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label>Telemóvel</label>
                        <p id="view_phone" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label>Curso</label>
                        <p id="view_course" class="form-control"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>PHP CRUD

                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#studentAddModal">
                                Novo Estudante
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
                                    <th>Telemóvel</th>
                                    <th>Curso</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require 'dbcon.php';
                                $query = "SELECT * FROM students";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $estudantes) {
                                        ?>
                                        <tr>
                                            <td><?= $estudantes['id'] ?></td>
                                            <td><?= $estudantes['name'] ?></td>
                                            <td><?= $estudantes['email'] ?></td>
                                            <td><?= $estudantes['phone'] ?></td>
                                            <td><?= $estudantes['course'] ?></td>

                                            <td>
                                                <button type="button" value="<?= $estudantes['id']; ?>"
                                                    class="viewStudentBtn btn btn-secondary btn-sm">Vizualizar Aluno</button>
                                                <button type="button" value="<?= $estudantes['id']; ?>"
                                                    class="editStudentBtn btn btn-primary btn-sm">Atualizar Aluno</button>
                                                <a href="" class="btn btn-danger btn-sm">Excluir Aluno</a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                }
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

    <script>
        $(document).on('submit', '#saveStudent', function (e) {
            e.preventDefault();

            //Cria um objeto formdata com os dados do formulario.
            var formData = new FormData(this);

            //Acrescenta aos dados do formulário o parâmetro como true.
            formData.append("save_student", true);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,

                //Em caso de sucesso, recebe em 'response' os dodos devolvidos pelo servidor.
                success: function (response) {
                    var resultado = jQuery.parseJSON(response);

                    if (resultado.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(resultado.message);
                    } else if (resultado.status == 200) {

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveStudent')[0].reset();

                        $('#myTable').load(location.href + " #myTable");
                    }
                }
            });
        });

        $(document).on('click', '.editStudentBtn', function (e) {

            var student_id = $(this).val();
            // alert(student_id);

            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {
                    var resultado = jQuery.parseJSON(response);

                    if (resultado.status == 404) {
                        alert(resultado.message);
                    } else if (resultado.status == 422) {

                        $('#student_id').val(resultado.data.id);
                        $('#name').val(resultado.data.name);
                        $('#email').val(resultado.data.email);
                        $('#phone').val(resultado.data.phone);
                        $('#course').val(resultado.data.course);
                        $('#studentEditModal').modal('show');
                    }
                }

            });
        });

        $(document).on('submit', '#updateStudent', function (e) {
            e.preventDefault();

            //Cria um objeto formdata com os dados do formulario.
            var formData = new FormData(this);

            //Acrescenta aos dados do formulário o parâmetro como true.
            formData.append("update_student", true);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,

                //Em caso de sucesso, recebe em 'response' os dodos devolvidos pelo servidor.
                success: function (response) {
                    var resultado = jQuery.parseJSON(response);

                    if (resultado.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(resultado.message);
                    } else if (resultado.status == 200) {

                        $('#errorMessageUpdate').addClass('d-none');
                        $('#studentEditModal').modal('hide');
                        $('#saveStudent')[0].reset();

                        $('#myTable').load(location.href + " #myTable");
                    }
                }
            });
        });
        $(document).on('click', '.viewStudentBtn', function (e) {

            var student_id = $(this).val();
            // alert(student_id);

            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {
                    var resultado = jQuery.parseJSON(response);

                    if (resultado.status == 404) {
                        alert(resultado.message);
                    } else if (resultado.status == 422) {

                        $('#view_name').text(resultado.data.name);
                        $('#view_email').text(resultado.data.email);
                        $('#view_phone').text(resultado.data.phone);
                        $('#view_course').text(resultado.data.course);
                        $('#studentViewModal').modal('show');
                    }
                }

            });
        });
    </script>
</body>

</html>